<?php

namespace App\Modules;

use App\Facebook\FacebookAccessToken;
use Illuminate\Support\Facades\Http;

class Facebook
{
    private $accessToken;

    public function __construct()
    {
        $this->accessToken = new FacebookAccessToken();
    }

    public function searchLeads($categoryName, $keyword, $token)
    {
        $response = Http::get("https://graph.facebook.com/v17.0/pages/search?q={$categoryName},{$keyword}&fields=id,name,location,link&access_token={$token}");

        $data = collect(json_decode($response)->data);

        return $data;
    }
}
