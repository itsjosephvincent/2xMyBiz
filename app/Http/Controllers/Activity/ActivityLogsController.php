<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserProfileSocialLink;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsController extends Controller
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
        $activities = Activity::where('causer_type', 'App\Models\User')->where('causer_id', $userId)->paginate(5);
        $userProfiles = UserProfileSocialLink::where('user_id', $userId)->first();

        return view('profile-pages.activity-logs', [
            'currentUser' => $currentUser,
            'activities' => $activities,
            'userProfiles' => $userProfiles,
            'data' => $data
        ]);
    }
}
