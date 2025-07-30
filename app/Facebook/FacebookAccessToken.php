<?php

namespace App\Facebook;

use App\Models\FacebookUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FacebookAccessToken
{
    public function getFacebookAccessToken()
    {
        $client = new Client();

        $response = $client->request('GET', 'https://graph.facebook.com/oauth/access_token', [
            'query' => [
                'client_id' => env('FACEBOOK_CLIENT_ID'),
                'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
                'grant_type' => 'client_credentials'
            ]
        ]);

        $accessToken = json_decode($response->getBody())->access_token;

        return $accessToken;
    }

    public function pagePermissionAccessToken()
    {
        $response = Http::get('https://graph.facebook.com/oauth/access_token', [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'grant_type' => 'client_credentials',
            'scope' => 'pages_show_list,instagram_basic,pages_read_engagement,pages_read_user_content,pages_manage_posts,pages_manage_engagement'
        ]);

        $data = $response->json();

        $accessToken = $data['access_token'];

        return $accessToken;
    }

    public function getPageAccessToken()
    {
        $appId = env('FACEBOOK_CLIENT_ID'); // Replace with your Facebook application ID
        $appSecret = env('FACEBOOK_CLIENT_SECRET'); // Replace with your Facebook application secret
        $user = FacebookUser::where('user_id', auth()->user()->id)->first();

        // Send a GET request to the Graph API to retrieve the page access token
        $response = Http::get("https://graph.facebook.com/v12.0/{$user->facebook_id}/accounts", [
            'access_token' => "{$appId}|{$appSecret}",
        ]);

        // Decode the JSON response
        $data = $response->json();

        // // Extract and return the page access token
        // $pageAccessToken = $data['data'][0]['access_token'];

        return $data;
    }
}
