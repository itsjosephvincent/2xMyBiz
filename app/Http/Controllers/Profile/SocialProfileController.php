<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserProfileSocialLink;
use Illuminate\Http\Request;

class SocialProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $userDetails = UserDetails::where('user_id', $userId)->first();
        $userProfiles = UserProfileSocialLink::where('user_id', $userId)->first();

        return view('profile-pages.social-profiles', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'userProfiles' => $userProfiles,
            'data' => $data
        ]);
    }

    public function storeFacebook(Request $request)
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'facebook' => $request->facebook_url
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function storeTwitter(Request $request)
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'twitter' => $request->twitter_url
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function storeLinkedin(Request $request)
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'linkedin' => $request->linkedin_url
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function storeYoutube(Request $request)
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'youtube' => $request->youtube_url
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function storeInstagram(Request $request)
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'instagram' => $request->instagram_url
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function destroyFacebook()
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'facebook' => null
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function destroyTwitter()
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'twitter' => null
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function destroyLinkedin()
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'linkedin' => null
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function destroyYoutube()
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'youtube' => null
            ]
        );

        return redirect()->route('social-profiles');
    }

    public function destroyInstagram()
    {
        $userId = auth()->user()->id;

        UserProfileSocialLink::updateOrCreate(
            [
                'user_id' => $userId
            ],
            [
                'instagram' => null
            ]
        );

        return redirect()->route('business-calender');
    }
}
