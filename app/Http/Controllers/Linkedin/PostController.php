<?php

namespace App\Http\Controllers\Linkedin;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\LinkedInUser;
use App\Models\PostTemplate;
use App\Models\PostTemplateCategory;
use App\Models\ScheduledPost;
use App\Models\User;
use App\Models\UserBusiness;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

        return view('linkedin.linkedin-post-list', [
            'currentUser' => $currentUser,
            'posts' => $posts,
            'data' => $data,
            'categories' => $categories
        ]);
    }

    public function createLinkedinPostWithWatermak($id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $post = PostTemplate::findOrFail($id);
        $userBusiness = UserBusiness::where('user_id', $userId)->first();
        $linkedinPosts = ScheduledPost::where('user_id', $userId)
            ->whereNull('page_id')
            ->where('platform', 'LinkedIn')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $waterMark = file_get_contents($userBusiness->business_logo);
        $newWatermark = Image::make($waterMark)->resize(300, 300);

        $image = Image::make(public_path('storage/post_images/' . $post->image_url));
        $image->insert($newWatermark, 'bottom-right', 10, 10);

        $newDirectory = public_path('storage/watermarked/');
        $newFilename = 'watermarked_user-' . $currentUser->id . '-post-' . $post->id . '-' . $post->image_url;

        $image->save($newDirectory . $newFilename, 100, 'png');

        return view('linkedin.linkedin-post', [
            'currentUser' => $currentUser,
            'post' => $post,
            'data' => $data,
            'userBusiness' => $userBusiness,
            'linkedinPosts' => $linkedinPosts,
            'waterMarked' => $newFilename
        ]);
    }

    public function createLinkedinPostWithoutWatermak($id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $post = PostTemplate::findOrFail($id);
        $userBusiness = UserBusiness::where('user_id', $userId)->first();
        $linkedinPosts = ScheduledPost::where('user_id', $userId)
            ->whereNull('page_id')
            ->where('platform', 'LinkedIn')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('linkedin.linkedin-post', [
            'currentUser' => $currentUser,
            'post' => $post,
            'data' => $data,
            'userBusiness' => $userBusiness,
            'linkedinPosts' => $linkedinPosts,
            'waterMarked' => ''
        ]);
    }

    public function createNewLinkedinPost()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $linkedinPosts = ScheduledPost::where('user_id', $userId)
            ->whereNull('page_id')
            ->where('platform', 'LinkedIn')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('linkedin.create-new-post', [
            'currentUser' => $currentUser,
            'data' => $data,
            'linkedinPosts' => $linkedinPosts
        ]);
    }

    public function postTemplate(Request $request)
    {
        $userId = auth()->user()->id;
        $user = LinkedInUser::where('user_id', $userId)->first();

        $file = file_get_contents($request->postattachment);

        $registerUploadResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->token,
            'Content-Type' => 'application/json',
            'X-RestLi-Protocol-Version' => '2.0.0'
        ])->post('https://api.linkedin.com/v2/assets?action=registerUpload', [
            'registerUploadRequest' => [
                'recipes' => [
                    'urn:li:digitalmediaRecipe:feedshare-image'
                ],
                'owner' => 'urn:li:person:' . $user->linkedin_id,
                'serviceRelationships' => [
                    [
                        'relationshipType' => 'OWNER',
                        'identifier' => 'urn:li:userGeneratedContent'
                    ]
                ]
            ]
        ]);

        $data = json_decode($registerUploadResponse, true);
        $uploadUrl = $data['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'];
        $asset = $data['value']['asset'];

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->token
        ])->withBody($file, '')->post($uploadUrl);

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->token,
            'X-Restli-Protocol-Version' => '2.0.0',
        ])->post('https://api.linkedin.com/v2/ugcPosts', [
            'author' => 'urn:li:person:' . $user->linkedin_id,
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $request->postcontent
                    ],
                    'shareMediaCategory' => 'IMAGE',
                    'media' => [
                        [
                            'status' => 'READY',
                            'description' => [
                                'text' => Str::random(16),
                            ],
                            'media' => $asset,
                            'title' => [
                                'text' => $request->postcontent
                            ]
                        ]
                    ]
                ]
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC'
            ]
        ]);

        $newPost = new ScheduledPost();
        $newPost->user_id = $userId;
        $newPost->post_id = isset($request->post_id) ? $request->post_id : null;
        $newPost->title = isset($request->post_title) ? $request->post_title : null;
        $newPost->content = $request->postcontent;
        $newPost->attachment = $asset;
        $newPost->platform = 'LinkedIn';
        $newPost->date = Carbon::now()->format('Y-m-d');
        $newPost->time = Carbon::now()->format('H:i:s');
        $newPost->is_posted = 1;
        $newPost->save();

        return redirect()->back();
    }
}
