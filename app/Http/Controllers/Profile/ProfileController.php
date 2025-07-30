<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserProfileSocialLink;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProfileController extends Controller
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

        return view('profile-pages.personal-info', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'userProfiles' => $userProfiles,
            'data' => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        User::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email_address,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
            ]
        );

        UserDetails::updateOrCreate(
            [
                'user_id' => $id
            ],
            [
                'contact_number' => $request->contact_number,
                'address1' => $request->address
            ]
        );

        return redirect()->back();
    }

    public function udpateProfilePhoto(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);
        $media = Media::where('model_id', $userId)->where('model_type', 'App\Models\User')->first();
        if ($media) {
            $media->forceDelete($media->id);
        }
        $user->addMediaFromRequest('profilePhoto')->toMediaCollection('user');
        $user->profile_photo = $user->getMedia('user')->last()->getUrl();
        $user->save();

        $facebook = FacebookUser::where('user_id', $userId)->first();
        $facebook->avatar = $user->profile_photo;
        $facebook->save();

        return redirect()->back();
    }
}
