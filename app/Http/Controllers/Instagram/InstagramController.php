<?php

namespace App\Http\Controllers\Instagram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class InstagramController extends Controller
{
    public function provider()
    {
        $baseUri = 'https://www.facebook.com/v17.0/dialog/oauth';
        $params = [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'redirect_uri' => env('INSTAGRAM_REDIRECT_URI'),
            'scope' => 'pages_show_list,instagram_basic',
            'response_type' => 'code'
        ];

        $uri = $baseUri . '?' . http_build_query($params);

        return Redirect::away($uri);
    }

    public function callback(Request $request)
    {
        $tokenUri = 'https://graph.facebook.com/v17.0/oauth/access_token';
        $params = [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'redirect_uri' => env('INSTAGRAM_REDIRECT_URI'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'code' => $request->code,
        ];

        $response = Http::get($tokenUri, $params);

        $accessToken = $response['access_token'];

        $pagesUri = 'https://graph.facebook.com/v17.0/me/accounts';
        $pagesParams = [
            'access_token' => $accessToken,
        ];

        $pagesResponse = Http::get($pagesUri, $pagesParams);
        $pagesData = $pagesResponse->json();

        return $pagesData;
    }
}
