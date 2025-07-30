<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserProfileSocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
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

        return view('profile-pages.password-change', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'userProfiles' => $userProfiles,
            'data' => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password != $request->password_confirmation) {
                return back()->with('error', 'Password does not match.');
            }
            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('success', 'Password updated successfully.');
        }

        return back()->with('error', 'Invalid password.');
    }
}
