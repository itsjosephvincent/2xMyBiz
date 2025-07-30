<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\InstagramUser;
use App\Models\LinkedInUser;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserProfileSocialLink;

class IntegrationController extends Controller
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
        $facebook = FacebookUser::where('user_id', $userId)->first();
        $linkedin = LinkedInUser::where('user_id', $userId)->first();
        $instagram = InstagramUser::where('user_id', $userId)->first();
        $userProfiles = UserProfileSocialLink::where('user_id', $userId)->first();

        return view('profile-pages.integrations', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'facebook' => $facebook,
            'linkedin' => $linkedin,
            'instagram' => $instagram,
            'userProfiles' => $userProfiles,
            'data' => $data
        ]);
    }
}
