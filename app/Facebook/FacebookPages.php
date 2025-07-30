<?php

namespace App\Facebook;

use App\Models\InstagramUser;
use App\Models\UserFacebookPage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookPages
{
    public function getFacebookPages($userId, $facebookUserId, $facebookUserToken)
    {
        $response = Http::get('https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id=' . env('FACEBOOK_CLIENT_ID') . '&client_secret=' . env('FACEBOOK_CLIENT_SECRET') . '&fb_exchange_token=' . $facebookUserToken);

        $data = $response->json();
        $accessToken = $data['access_token'];

        $pageResponse = Http::get('https://graph.facebook.com/' . $facebookUserId . '/accounts?fields=name,access_token,id&access_token=' . $accessToken);

        $pages = json_decode($pageResponse)->data;

        foreach ($pages as $page) {

            $insta = Http::get('https://graph.facebook.com/v18.0/' . $page->id . '?fields=instagram_business_account,access_token&access_token=' . $page->access_token);

            $instaData = $insta->json();

            if (isset($instaData['instagram_business_account'])) {
                $instagram = new InstagramUser();
                $instagram->user_id = $userId;
                $instagram->instagram_id = $instaData['instagram_business_account']['id'];
                $instagram->access_token = $instaData['access_token'];
                $instagram->save();
            }

            $imageResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get('https://graph.facebook.com/' . $page->id . '/picture?type=large&redirect&access_token=' . $accessToken);

            $image = json_decode($imageResponse)->data;

            UserFacebookPage::updateOrCreate(
                [
                    'user_id' => $userId,
                    'page_id' => $page->id
                ],
                [
                    'page_name' => $page->name,
                    'page_access_token' => $page->access_token,
                    'page_photo' => $image->url
                ]
            );
        }

        return $pages;
    }
}
