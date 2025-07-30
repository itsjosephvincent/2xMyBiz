<?php

namespace App\Http\Controllers\SendNotifications;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\SendNotifications;
use App\Models\User;
use App\Notifications\AnnouncementNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $notifs = SendNotifications::paginate(10);

        return view('pages.notifications', [
            'currentUser' => $currentUser,
            'notifs' => $notifs,
            'data' => $data
        ]);
    }

    public function create()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $notifs = SendNotifications::all();

        return view('notification-pages.create-notification', [
            'currentUser' => $currentUser,
            'notifs' => $notifs,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $notification = new SendNotifications();
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->save();

        $users = User::all();

        foreach ($users as $user) {
            $user->notify(new AnnouncementNotification($notification->title, $notification->message));
        }

        return redirect()->back();
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->unreadNotifications()->findOrFail($notificationId);
        $notification->markAsRead();

        $notificationCount = auth()->user()->unreadNotifications->count();

        return response()->json([
            'notificationCount' => $notificationCount,
        ]);
    }
}
