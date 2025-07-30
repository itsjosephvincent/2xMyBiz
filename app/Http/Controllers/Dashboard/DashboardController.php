<?php

namespace App\Http\Controllers\Dashboard;

use App\Charts\DealsChart;
use App\Charts\UserLeadsChart;
use App\Http\Controllers\Controller;
use App\Models\AffiliatePartner;
use App\Models\DashboardCount;
use App\Models\FacebookUser;
use App\Models\Lead;
use App\Models\LeadGroup;
use App\Models\LinkedInUser;
use App\Models\LostReasonCount;
use App\Models\Organization;
use App\Models\ScheduledPost;
use App\Models\User;
use App\Models\UserBusiness;
use App\Models\UserDetails;
use App\Models\UserFacebookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;

        $data = FacebookUser::where('user_id', $userId)->first();
        $currentUser = User::findOrFail($userId);
        $userDetails = UserDetails::where('user_id', $userId)->first();
        $linkedin = LinkedInUser::where('user_id', $userId)->first();
        $lead_count = Lead::where('user_id', $userId)->count();
        $leadgroup_count = Organization::where('user_id', null)->count();
        $myleadgroup_count = Organization::where('user_id', $userId)->count();
        $dash_count = DashboardCount::where('user_id', $userId)->first();
        $closed_count = Lead::whereIn('lead_group_id', ['11', '12'])->count();
        $facebook = FacebookUser::where('user_id', $userId)->first();
        $business = UserBusiness::where('user_id', $userId)->first();

        $leadgroups = LeadGroup::orderBy('id', 'asc')->get();
        $leadgroupnames = [];
        $leadscount = [];
        foreach ($leadgroups as $leadgroup) {
            array_push($leadgroupnames, $leadgroup->lead_group_name);
            $leadstotal = Lead::where('lead_group_id', $leadgroup->id)
                ->where('user_id', auth()->user()->id)
                ->count();
            array_push($leadscount, $leadstotal);
        }

        $posts = ScheduledPost::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $responseArray = [];
        foreach ($posts as $post) {
            $page = UserFacebookPage::where('page_id', $post->page_id)->first();

            if ($page) {
                $comments = Http::get('https://graph.facebook.com/v17.0/' . $post->post_id . '/comments?summary=total_count&access_token=' . $page->page_access_token);
                $commentData = $comments->json();

                $likes = Http::get('https://graph.facebook.com/v17.0/' . $post->post_id . '/likes?summary=total_count&access_token=' . $page->page_access_token);
                $likeData = $likes->json();

                if (isset($commentData['summary']['total_count']) && isset($likeData['summary']['total_count'])) {
                    $responseArray[] = [
                        'post_title' => $post->title,
                        'total_comments' => json_encode($commentData['summary']['total_count']),
                        'total_likes' => json_encode($likeData['summary']['total_count'])
                    ];
                } else {
                    $responseArray[] = [
                        'post_title' => $post->title,
                        'total_comments' => 0,
                        'total_likes' => 0
                    ];
                }
            }
        }

        $notQualified = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 1)
            ->first();
        $costHigh = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 2)
            ->first();
        $notRightTime = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 3)
            ->first();
        $notInterested = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 4)
            ->first();
        $notNeeded = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 5)
            ->first();
        $haveGuy = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 6)
            ->first();
        $tooLong = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 7)
            ->first();
        $noBusiness = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 8)
            ->first();
        $other = LostReasonCount::where('user_id', $userId)
            ->where('lost_reason_id', 9)
            ->first();

        return view('pages.dashboard', [
            'data' => $data,
            'currentUser' => $currentUser,
            'lead_count' => $lead_count,
            'leadgroup_count' => $leadgroup_count + $myleadgroup_count,
            'dash_count' => $dash_count,
            'closed_count' => $closed_count,
            'leadgroupnames' => $leadgroupnames,
            'leadscount' => $leadscount,
            'facebook' => $facebook,
            'linkedin' => $linkedin,
            'posts' => isset($responseArray) ? $responseArray : null,
            'contact' => isset($userDetails->contact_number) ? $userDetails->contact_number : null,
            'address' => isset($userDetails->address1) ? $userDetails->address1 : null,
            'bname' => isset($business->business_name) ? $business->business_name : null,
            'bweb' => isset($business->business_website) ? $business->business_website : null,
            'bemail' => isset($business->business_email) ? $business->business_email : null,
            'bphone' => isset($business->business_phone) ? $business->business_phone : null,
            'baddress' => isset($business->business_address) ? $business->business_address : null,
            'babout' => isset($business->about_us) ? $business->about_us : null,
            'bmessage' => isset($business->audit_message) ? $business->audit_message : null,
            'blogo' => isset($business->business_logo) ? $business->business_logo : null,
            'bbanner' => isset($business->business_banner) ? $business->business_banner : null,
            'bcalendar' => isset($business->business_calendar_link) ? $business->business_calendar_link : null,
            'notQualified' => isset($notQualified->count) ? $notQualified->count : 0,
            'costHigh' => isset($costHigh->count) ? $costHigh->count : 0,
            'notRightTime' => isset($notRightTime->count) ? $notRightTime->count : 0,
            'notInterested' => isset($notInterested->count) ? $notInterested->count : 0,
            'notNeeded' => isset($notNeeded->count) ? $notNeeded->count : 0,
            'haveGuy' => isset($haveGuy->count) ? $haveGuy->count : 0,
            'tooLong' => isset($tooLong->count) ? $tooLong->count : 0,
            'noBusiness' => isset($noBusiness->count) ? $noBusiness->count : 0,
            'other' => isset($other->count) ? $other->count : 0,
        ]);
    }
}
