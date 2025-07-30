<?php

namespace App\Http\Controllers\Facebook;

use App\Facebook\FacebookPages;
use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserFacebookPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    private $facebookPage;

    public function __construct(FacebookPages $facebookPage)
    {
        $this->facebookPage = $facebookPage;
    }

    public function provider()
    {
        $baseUri = 'https://www.facebook.com/v13.0/dialog/oauth';
        $params = [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'redirect_uri' => env('FACEBOOK_REDIRECT'),
            'scope' => 'pages_show_list,instagram_basic,pages_read_engagement,pages_read_user_content,pages_manage_posts,pages_manage_engagement,business_management,ads_management,instagram_content_publish',
        ];

        $uri = $baseUri . '?' . http_build_query($params);
        return redirect()->away($uri);
    }

    public function callback(Request $request)
    {
        $tokenUri = 'https://graph.facebook.com/oauth/access_token';
        $params = [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'redirect_uri' => env('FACEBOOK_REDIRECT'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'code' => $request->code,
        ];

        $response = Http::get($tokenUri, $params);

        $accessToken = $response['access_token'];

        $profileUri = 'https://graph.facebook.com/me';

        $profileParams = [
            'access_token' => $accessToken,
            'fields' => 'id,name,email,picture.width(720).height(720)',
        ];

        $profileResponse = Http::get($profileUri, $profileParams);
        $profileData = $profileResponse->json();
        $pictureUrl = $profileData['picture']['data']['url'];

        FacebookUser::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'facebook_id' => $profileData['id'],
                'email' => isset($profileData['email']) ? $profileData['email'] : null,
                'avatar' => $pictureUrl,
            ]
        );

        $this->facebookPage->getFacebookPages(auth()->user()->id, $profileData['id'], $accessToken);

        return redirect()->route('dashboard');
    }

    public function redirectToFacebookProvider()
    {
        $baseUri = 'https://www.facebook.com/v13.0/dialog/oauth';
        $params = [
            'client_id' => env('FACEBOOK_LOGIN_CLIENT_ID'),
            'redirect_uri' => env('FACEBOOK_LOGIN_REDIRECT'),
            'scope' => 'pages_show_list,instagram_basic,pages_read_engagement,pages_read_user_content,pages_manage_posts,pages_manage_engagement,business_management,ads_management,instagram_content_publish',
        ];

        $uri = $baseUri . '?' . http_build_query($params);

        return redirect()->away($uri);
    }

    public function handleFacebookProviderCallback(Request $request)
    {
        $tokenUri = 'https://graph.facebook.com/oauth/access_token';
        $params = [
            'client_id' => env('FACEBOOK_LOGIN_CLIENT_ID'),
            'redirect_uri' => env('FACEBOOK_LOGIN_REDIRECT'),
            'client_secret' => env('FACEBOOK_LOGIN_CLIENT_SECRET'),
            'code' => $request->code
        ];

        $response = Http::get($tokenUri, $params);

        $accessToken = $response['access_token'];

        $profileUri = 'https://graph.facebook.com/me';

        $profileParams = [
            'access_token' => $accessToken,
            'fields' => 'id,first_name,last_name,email,picture.width(720).height(720)',
        ];

        $profileResponse = Http::get($profileUri, $profileParams);
        $profileData = $profileResponse->json();
        $pictureUrl = $profileData['picture']['data']['url'];

        if (isset($profileData['email'])) {
            $authUser = User::where('email', $profileData['email'])->first();

            if (!$authUser) {
                $authUser = new User();
                $authUser->facebook_id = $profileData['id'];
                $authUser->first_name = $profileData['first_name'];
                $authUser->last_name = $profileData['last_name'];
                $authUser->email = $profileData['email'];
                $authUser->save();
                $authUser->assignRole('Free');
                $authUser->givePermissionTo(['manage_leads', 'create_email']);
            }

            Auth::login($authUser);

            FacebookUser::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                ],
                [
                    'facebook_id' => $profileData['id'],
                    'email' => isset($profileData['email']) ? $profileData['email'] : null,
                    'avatar' => $pictureUrl,
                ]
            );
        } else {
            $authUser = User::where('facebook_id', $profileData['id'])->first();

            if (!$authUser) {
                $authUser = new User();
                $authUser->facebook_id = $profileData['id'];
                $authUser->first_name = $profileData['first_name'];
                $authUser->last_name = $profileData['last_name'];
                $authUser->save();
                $authUser->assignRole('Free');
                $authUser->givePermissionTo(['manage_leads', 'create_email']);
            }

            Auth::login($authUser);

            FacebookUser::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                ],
                [
                    'facebook_id' => $profileData['id'],
                    'email' => isset($profileData['email']) ? $profileData['email'] : null,
                    'avatar' => $pictureUrl,
                ]
            );
        }

        $this->facebookPage->getFacebookPages(auth()->user()->id, $profileData['id'], $accessToken);

        return redirect()->route('dashboard');
    }
}
