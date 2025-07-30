<?php

namespace App\Http\Controllers\Scraper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ScraperController extends Controller
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('SCRAPER_API_KEY');
    }

    public function index(Request $request)
    {
        // $business = 'Accounting';
        // $baseUrl = "https://www.bing.com";
        // $query = "/search?q=site:linkedin.com/company {$business}";
        // $currentPage = $baseUrl . $query;

        // do {
        //     $crawler = GoutteFacade::request('GET', $currentPage);

        //     $crawler->filter('li.b_algo h2 a')->each(function ($node) use (&$results) {
        //         $title = str_replace(' | LinkedIn', '', $node->text()); // Remove " | LinkedIn" string
        //         $result = [
        //             'title' => $title,
        //             'href' => $node->attr('href'),
        //         ];
        //         $results[] = $result;
        //     });

        //     $nextPageLink = $crawler->filter('a.sb_pagN')->first();

        //     if ($nextPageLink->count() > 0) {
        //         $nextPageUrl = $nextPageLink->attr('href');
        //         $currentPage = $baseUrl . $nextPageUrl;
        //     } else {
        //         break;
        //     }
        // } while (true);

        // return $results;

        // $result = [];
        // $crawler = GoutteFacade::request('GET', 'https://www.linkedin.com/company/frontlineaccounting');

        // $crawler->filter('h1.top-card-layout__title')->each(function ($node) use (&$result) {
        //     $result['company_name'] = $node->text();
        // });

        // $crawler->filter('#address-0')->each(function ($node) use (&$result) {
        //     $result['address'] = $node->text();
        // });

        // $crawler->filter('#address-0')->each(function ($node) use (&$result) {
        //     $result['address'] = $node->text();
        // });

        // $crawler->filter('div[data-test-id="about-us__specialties"] dd')->each(function ($node) use (&$result) {
        //     $result['specialties'] = $node->text();
        // });

        // $crawler->filter('div[data-test-id="about-us__size"] dd')->each(function ($node) use (&$result) {
        //     $result['company_size'] = $node->text();
        // });

        // $crawler->filter('div[data-test-id="about-us__industry"] dd')->each(function ($node) use (&$result) {
        //     $result['industry'] = $node->text();
        // });

        // $crawler->filter('div[data-test-id="about-us__organizationType"] dd')->each(function ($node) use (&$result) {
        //     $result['company_type'] = $node->text();
        // });

        // $crawler->filter('div[data-test-id="about-us__foundedOn"] dd')->each(function ($node) use (&$result) {
        //     $result['founded'] = $node->text();
        // });

        // $crawler->filter('div[data-test-id="about-us__website"] a')->each(function ($node) use (&$result) {
        //     $result['website'] = $node->text();
        // });

        // $crawler->filter('img[data-delayed-url]')->each(function ($node) use (&$result) {
        //     $result['image_link'] = $node->attr('data-delayed-url');
        // });

        // var_dump($result);

        // return $crawler->html();
    }

    public function scrapeAllPages()
    {
        $category = 'Restaurant';
        $baseUrl = "https://www.bing.com/";
        $currentPage = "{$baseUrl}/search?q=site:linkedin.com/company {$category}";

        $client = new Client();
        $scrapedData = [];

        for ($i = 1; $i < 50; $i++) {
            $response = $client->get($currentPage);

            if ($response->getStatusCode() === 200) {
                $html = $response->getBody()->getContents();

                $crawler = new Crawler($html);

                // Process the current page and store the data
                $scrapedData[] = $this->processPage($crawler); // Implement your logic to extract data from the page

                // Find the form element with class "next_page"
                $form = $crawler->filter('form.next_page')->first();

                // Check if the form element is found
                if ($form->count() > 0) {
                    // Get the form's action attribute
                    $action = $form->attr('action');

                    // Construct the URL for the next page
                    $currentPage = "{$baseUrl}{$action}";
                }
            }
        }

        return $scrapedData;
    }

    function processPage(Crawler $crawler)
    {
        // Implement your logic to extract data from the page and return it as needed
        $data = [];

        // Example data extraction from the page
        $crawler->filter('.result-default h3 a')->each(function (Crawler $node) use (&$data) {
            $scraped = [
                'company' => $node->text(),
                'link' => $node->attr('href'),
            ];

            $data[] = $scraped;
        });

        return $data;
    }

    public function googleSearchApi()
    {
        $category = 'Restaurants';
        $keyword = 'Texas';
        $key = env('GOOGLE_API_KEY');
        $searchEngineKey = env('SEARCH_ENGINE_KEY');
        $query = "site:linkedin.com/company {$category} {$keyword}";
        $baseUrl = "https://www.googleapis.com/customsearch/v1?key={$key}&cx={$searchEngineKey}&q={$query}";

        $results = [];

        $start = 1;

        while (true) {
            $url = $baseUrl . "&start={$start}";

            $response = Http::get($url);
            $data = $response->json();

            if (isset($data['items']) && count($data['items']) > 0) {
                // Extract and format the results
                foreach ($data['items'] as $item) {
                    $title = str_replace(" | LinkedIn", "", $item['title']);
                    $link = $item['link'];
                    $snippet = $item['snippet'];
                    $cseImgSrc = $item['pagemap']['cse_image'][0]['src'];

                    // Add the formatted result to the results array
                    $results[] = [
                        'title' => $title,
                        'link' => $link,
                        'snippet' => $snippet,
                        'cse_img_src' => $cseImgSrc,
                    ];
                }
            }

            // Check if there is a next page
            if (isset($data['queries']['nextPage'])) {
                $start = $data['queries']['nextPage'][0]['startIndex'];
            } else {
                break; // No more pages
            }
        }

        return $results;
        // $response = Http::get($baseUrl);

        // return $response;

    }
}
