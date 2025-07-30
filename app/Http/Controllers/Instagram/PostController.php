<?php

namespace App\Http\Controllers\Instagram;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\PostTemplate;
use App\Models\PostTemplateCategory;
use App\Models\ScheduledPost;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
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
        $posts = PostTemplate::paginate(4);
        $categories = PostTemplateCategory::all();

        return view('instagram.instagram-post-list', [
            'currentUser' => $currentUser,
            'posts' => $posts,
            'data' => $data,
            'categories' => $categories
        ]);
    }

    public function createNewLinkedinPost()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $linkedinPosts = ScheduledPost::where('user_id', $userId)
            ->whereNull('page_id')
            ->where('platform', 'Instagram')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('instagram.create-new-post', [
            'currentUser' => $currentUser,
            'data' => $data,
            'linkedinPosts' => $linkedinPosts
        ]);
    }

    public function postTemplate(Request $request)
    {
    }
}
