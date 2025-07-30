<?php

namespace App\Http\Controllers\LinkedIn;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\Lead;
use App\Models\LinkedInCategory;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Weidner\Goutte\GoutteFacade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LeadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $currentUser = auth()->user();
        $categories = LinkedInCategory::orderBy('industry_label', 'asc')->get();
        $pages = [];
        $notifications = $currentUser->notifications;
        $data = FacebookUser::where('user_id', $currentUser->id)->first();
        $organizations = Organization::whereNull('user_id')->get();
        $myorganizations = Organization::where('user_id', $currentUser->id)->get();

        return view('lead-pages.find-linkedin-leads', [
            'currentUser' => $currentUser,
            'categories' => $categories,
            'pages' => $pages,
            'notifications' => $notifications,
            'data' => $data,
            'orgs' => $organizations,
            'myorgs' => $myorganizations,
        ]);
    }

    public function searchLeads(Request $request)
    {
        $user = auth()->user();
        $notifications = $user->notifications;
        $categories = LinkedInCategory::orderBy('industry_label', 'asc')->get();
        $data = FacebookUser::where('user_id', $user->id)->first();
        // $myleads = Lead::where('user_id', $user->id)->pluck('lead_id');
        // $blocked = BlockedLead::where('user_id', $user->id)->pluck('page_id');
        $organizations = Organization::whereNull('user_id')->get();
        $myorganizations = Organization::where('user_id', $user->id)->get();
        $key = env('GOOGLE_API_KEY');
        $searchEngineKey = env('SEARCH_ENGINE_KEY');
        $query = "site:linkedin.com/company {$request->category_name} {$request->keyword}";
        $baseUrl = "https://www.googleapis.com/customsearch/v1?key={$key}&cx={$searchEngineKey}&q={$query}";

        $results = [];

        $start = 1;

        while (true) {
            $url = $baseUrl . "&start={$start}";

            $response = Http::get($url);
            $data = $response->json();

            if (isset($data['items']) && count($data['items']) > 0) {
                foreach ($data['items'] as $item) {
                    $title = str_replace(" | LinkedIn", "", $item['title']);
                    $link = $item['link'];
                    $snippet = $item['snippet'];
                    $cseImgSrc = $item['pagemap']['cse_image'][0]['src'];

                    $results[] = [
                        'title' => $title,
                        'link' => $link,
                        'snippet' => $snippet,
                        'cse_img_src' => $cseImgSrc,
                    ];
                }
            }

            if (isset($data['queries']['nextPage'])) {
                $start = $data['queries']['nextPage'][0]['startIndex'];
            } else {
                break;
            }
        }

        return view('lead-pages.find-linkedin-leads', [
            'currentUser' => $user,
            'categoryName' => $request->category_name,
            'keyword' => $request->keyword,
            'categories' => $categories,
            'pages' => $results,
            'notifications' => $notifications,
            'data' => $data,
            'orgs' => $organizations,
            'myorgs' => $myorganizations,
        ]);
    }

    public function store(Request $request)
    {
        $scrape = [];
        $crawler = GoutteFacade::request('GET', $request->page_link);

        $crawler->filter('h1.top-card-layout__title')->each(function ($node) use (&$scrape) {
            $scrape['company_name'] = $node->text();
        });

        $crawler->filter('#address-0')->each(function ($node) use (&$scrape) {
            $scrape['address'] = $node->text();
        });

        $crawler->filter('div[data-test-id="about-us__specialties"] dd')->each(function ($node) use (&$scrape) {
            $scrape['specialties'] = $node->text();
        });

        $crawler->filter('div[data-test-id="about-us__size"] dd')->each(function ($node) use (&$scrape) {
            $scrape['company_size'] = $node->text();
        });

        $crawler->filter('div[data-test-id="about-us__industry"] dd')->each(function ($node) use (&$scrape) {
            $scrape['industry'] = $node->text();
        });

        $crawler->filter('div[data-test-id="about-us__organizationType"] dd')->each(function ($node) use (&$scrape) {
            $scrape['company_type'] = $node->text();
        });

        $crawler->filter('div[data-test-id="about-us__foundedOn"] dd')->each(function ($node) use (&$scrape) {
            $scrape['founded'] = $node->text();
        });

        $crawler->filter('div[data-test-id="about-us__website"] a')->each(function ($node) use (&$scrape) {
            $scrape['website'] = $node->text();
        });

        $crawler->filter('img[data-delayed-url]')->each(function ($node) use (&$scrape) {
            $scrape['image_link'] = $node->attr('data-delayed-url');
        });

        $lead = new Lead();
        $lead->user_id = auth()->user()->id;
        $lead->organization_id = $request->leadgroups;
        $lead->lead_group_id = 1;
        $lead->deal_id = 1;
        $lead->lead_photo = $scrape['image_link'];
        $lead->lead_name = $scrape['company_name'];
        $lead->website = $scrape['website'];
        $lead->linkedin = $request->page_link;
        $lead->street = $scrape['address'];
        $lead->save();

        return $lead;
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
