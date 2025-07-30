<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\InstagramUser;
use App\Models\LinkedInUser;
use App\Models\PostTemplate;
use App\Models\PostTemplateCategory;
use App\Models\ScheduledPost;
use App\Models\User;
use App\Models\UserBusiness;
use App\Models\UserFacebookPage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

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

        return view('facebook.facebook-post-list', [
            'currentUser' => $currentUser,
            'posts' => $posts,
            'data' => $data,
            'categories' => $categories
        ]);
    }

    public function category()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $categories = PostTemplateCategory::all();

        return view('facebook.post-category-list', [
            'currentUser' => $currentUser,
            'categories' => $categories,
            'data' => $data
        ]);
    }

    public function storeCategory(Request $request)
    {
        $category = new PostTemplateCategory();
        $category->category_name = $request->category_name;
        $category->save();

        Alert::success('Success', 'Post category successfully created.');

        return redirect()->back();
    }

    public function deleteCategory($id)
    {
        PostTemplateCategory::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function create()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $categories = PostTemplateCategory::all();

        return view('facebook.create-post', [
            'currentUser' => $currentUser,
            'data' => $data,
            'categories' => $categories,
        ]);
    }

    public function createFacebookPostWithWatermark($id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $pages = UserFacebookPage::where('user_id', $userId)->get();
        $post = PostTemplate::findOrFail($id);
        $userBusiness = UserBusiness::where('user_id', $userId)->first();
        $scheduledPosts = ScheduledPost::join('user_facebook_pages', 'scheduled_posts.page_id', '=', 'user_facebook_pages.page_id')
            ->select('user_facebook_pages.page_name', 'user_facebook_pages.page_photo', 'scheduled_posts.*')
            ->where('scheduled_posts.user_id', $userId)
            ->where('scheduled_posts.platform', 'Facebook')
            ->orderBy('scheduled_posts.created_at', 'desc')
            ->limit(5)
            ->get();

        if (isset($userBusiness->business_logo)) {
            $waterMark = file_get_contents($userBusiness->business_logo);
            $newWatermark = Image::make($waterMark)->resize(150, 150);

            $postImage = file_get_contents($post->image_url);
            $image = Image::make($postImage);
            $image->insert($newWatermark, 'bottom-right', 10, 10);

            $newDirectory = public_path('storage/watermarked/');
            $newFilename = 'watermarked_user-' . $currentUser->id . '-post-' . $post->id;

            $image->save($newDirectory . $newFilename, 100, 'png');

            $imageUrl =  asset('storage/watermarked/' . $newFilename);

            return view('facebook.facebook-post-watermark', [
                'currentUser' => $currentUser,
                'pages' => $pages,
                'post' => $post,
                'scheduledPosts' => $scheduledPosts,
                'data' => $data,
                'waterMarked' => $imageUrl
            ]);
        }

        return view('facebook.facebook-post-watermark', [
            'currentUser' => $currentUser,
            'pages' => $pages,
            'post' => $post,
            'scheduledPosts' => $scheduledPosts,
            'data' => $data,
            'waterMarked' => null
        ]);
    }

    public function createFacebookPostWithoutWatermark($id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $pages = UserFacebookPage::where('user_id', $userId)->get();
        $post = PostTemplate::findOrFail($id);
        $userBusiness = UserBusiness::where('user_id', $userId)->first();
        $scheduledPosts = ScheduledPost::join('user_facebook_pages', 'scheduled_posts.page_id', '=', 'user_facebook_pages.page_id')
            ->select('user_facebook_pages.page_name', 'user_facebook_pages.page_photo', 'scheduled_posts.*')
            ->where('scheduled_posts.user_id', $userId)
            ->where('scheduled_posts.platform', 'Facebook')
            ->orderBy('scheduled_posts.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('facebook.facebook-post', [
            'currentUser' => $currentUser,
            'pages' => $pages,
            'post' => $post,
            'scheduledPosts' => $scheduledPosts,
            'data' => $data,
            'userBusiness' => $userBusiness
        ]);
    }

    public function templates()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $posts = PostTemplate::paginate(4);

        return view('facebook.facebook-post-templates', [
            'currentUser' => $currentUser,
            'posts' => $posts,
            'data' => $data
        ]);
    }

    public function showTemplatesByCategory(Request $request)
    {
        $posts = PostTemplate::where('category_id', $request->category)->get();
        $category = PostTemplateCategory::findOrFail($request->category);

        return response()->json([
            'posts' => $posts,
            'category' => $category
        ]);
    }

    public function storeTemplate(Request $request)
    {
        $post = new PostTemplate();
        if ($request->hasFile('post_image')) {
            $post->category_id = $request->post_category;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();

            $addImage = PostTemplate::findOrFail($post->id);
            $media = Media::where('model_id', $addImage->id)
                ->where('model_type', 'App\Models\PostTemplate')
                ->where('collection_name', 'postTemplate')
                ->first();
            if ($media) {
                $media->forceDelete($media->id);
            }
            $addImage->addMediaFromRequest('post_image')->toMediaCollection('postTemplate');
            $addImage->image_url = $addImage->getMedia('postTemplate')->last()->getUrl();
            $addImage->save();
        } else {
            $post->category_id = $request->post_category;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image_url = null;
            $post->save();
        }

        return redirect()->route('post-templates');
    }

    public function showTemplate($id)
    {
        $post = PostTemplate::findOrFail($id);

        return $post;
    }

    public function postNow($id)
    {
        $post = ScheduledPost::findOrFail($id);
        $page = UserFacebookPage::where('page_id', $post->page_id)->first();

        Http::delete('https://graph.facebook.com/' . $post->post_id . '?access_token=' . $page->page_access_token);

        $imageApiUrl = 'https://graph.facebook.com/v17.0/' . $post->page_id . '/photos';
        $params = [
            'access_token' => $page->page_access_token,
            'url' => $post->attachment,
            'published' => false
        ];

        $photoResponse = Http::post($imageApiUrl, $params);
        $photoData = $photoResponse->json();
        $mediaId = $photoData['id'];

        $apiUrl = 'https://graph.facebook.com/' . $page->page_id . '/feed';
        $params = [
            'message' => $post->content,
            'access_token' => $page->page_access_token,
            'published' =>  true,
            'attached_media' => json_encode([
                [
                    'media_fbid' => $mediaId,
                ],
            ]),
        ];

        $postResponse = Http::post($apiUrl, $params);

        $postData = $postResponse->json();

        $post->post_id = $postData['id'];
        $post->date = Carbon::now()->format('Y-m-d');
        $post->time = Carbon::now()->format('H:i:s');
        $post->is_posted = 1;
        $post->save();

        return redirect()->back();
    }

    public function createNewSchedulePost(Request $request)
    {
        $pages = UserFacebookPage::whereIn('page_id', $request->pageToken)->get();

        if ($request->hasFile('post_image')) {

            $request->file('post_image')->storeAs(
                'post_images',
                $request->file('post_image')->getClientOriginalName(),
                'public'
            );

            $fileUrl = asset('storage/post_images/' . $request->file('post_image')->getClientOriginalName());

            foreach ($pages as $page) {
                $imageApiUrl = 'https://graph.facebook.com/v16.0/' . $page->page_id . '/photos';
                $params = [
                    'access_token' => $page->page_access_token,
                    'url' => $fileUrl,
                    'published' => false
                ];

                $photoResponse = Http::post($imageApiUrl, $params);
                $photoData = $photoResponse->json();
                $mediaId = $photoData['id'];

                $apiUrl = 'https://graph.facebook.com/' . $page->page_id . '/feed';

                $params = [
                    'message' => $request->postcontent,
                    'published' => true,
                    'access_token' => $page->page_access_token,
                    'attached_media' => json_encode([
                        [
                            'media_fbid' => $mediaId,
                        ],
                    ]),
                ];

                $postResponse = Http::post($apiUrl, $params);

                $sched = new ScheduledPost();
                $sched->user_id = auth()->user()->id;
                $sched->post_id = $postResponse['id'];
                $sched->page_id = $page->page_id;
                $sched->title = isset($request->title) ? $request->title : null;
                $sched->content = $request->postcontent;
                $sched->attachment = $mediaId;
                $sched->platform = 'Facebook';
                $sched->date = Carbon::now()->format('Y-m-d');
                $sched->time = Carbon::now()->format('H:i:s');
                $sched->is_posted = 0;
                $sched->save();
            }

            return redirect()->back();
        }
    }

    public function postWithoutWaterMark(Request $request)
    {
        $user_id = auth()->user()->id;
        $pages = UserFacebookPage::whereIn('page_id', $request->pageToken)->get();

        foreach ($pages as $page) {

            $imageApiUrl = 'https://graph.facebook.com/v18.0/' . $page->page_id . '/photos';

            $params = [
                'access_token' => $page->page_access_token,
                'url' => $request->postattachment,
                'published' => false
            ];

            $photoResponse = Http::post($imageApiUrl, $params);
            $photoData = $photoResponse->json();
            $mediaId = $photoData['id'];

            $apiUrl = 'https://graph.facebook.com/' . $page->page_id . '/feed';

            $params = [
                'message' => $request->postcontent,
                'published' => true,
                'access_token' => $page->page_access_token,
                'attached_media' => json_encode([
                    [
                        'media_fbid' => $mediaId,
                    ],
                ]),
            ];

            $response = Http::post($apiUrl, $params);

            $data = $response->json();

            $sched = new ScheduledPost();
            $sched->user_id = $user_id;
            $sched->post_id = $data['id'];
            $sched->page_id = $page->page_id;
            $sched->title = isset($request->title) ? $request->title : null;
            $sched->content = $request->postcontent;
            $sched->attachment = $request->postattachment;
            $sched->platform = 'Facebook';
            $sched->date = Carbon::now()->format('Y-m-d');
            $sched->time = Carbon::now()->format('H:i:s');
            $sched->is_posted = 1;
            $sched->save();
        }

        $linkedUser = LinkedInUser::where('user_id', $user_id)->first();

        $instaUser = InstagramUser::where('user_id', $user_id)->first();

        $file = file_get_contents($request->postattachment);

        if ($linkedUser) {
            $registerUploadResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $linkedUser->token,
                'Content-Type' => 'application/json',
                'X-RestLi-Protocol-Version' => '2.0.0'
            ])->post('https://api.linkedin.com/v2/assets?action=registerUpload', [
                'registerUploadRequest' => [
                    'recipes' => [
                        'urn:li:digitalmediaRecipe:feedshare-image'
                    ],
                    'owner' => 'urn:li:person:' . $linkedUser->linkedin_id,
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
                'Authorization' => 'Bearer ' . $linkedUser->token
            ])->withBody($file, '')->post($uploadUrl);

            Http::withHeaders([
                'Authorization' => 'Bearer ' . $linkedUser->token,
                'X-Restli-Protocol-Version' => '2.0.0',
            ])->post('https://api.linkedin.com/v2/ugcPosts', [
                'author' => 'urn:li:person:' . $linkedUser->linkedin_id,
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
            $newPost->user_id = $user_id;
            $newPost->post_id = isset($request->post_id) ? $request->post_id : null;
            $newPost->title = isset($request->post_title) ? $request->post_title : null;
            $newPost->content = $request->postcontent;
            $newPost->attachment = $asset;
            $newPost->platform = 'LinkedIn';
            $newPost->date = Carbon::now()->format('Y-m-d');
            $newPost->time = Carbon::now()->format('H:i:s');
            $newPost->is_posted = 1;
            $newPost->save();
        }

        if ($instaUser) {
            $response =  Http::post('https://graph.facebook.com/v18.0/' . $instaUser->instagram_id . '/media?image_url=' . $request->postattachment . '&caption=' . $request->postcontent . '&access_token=' . $instaUser->access_token);

            $instaResponse = $response->json();

            Http::post('https://graph.facebook.com/v18.0/' . $instaUser->instagram_id . '/media_publish?creation_id=' . $instaResponse['id'] . '&access_token=' . $instaUser->access_token);
        }

        Alert::success('Success', 'Content successfully posted!');

        return redirect()->back();
    }

    public function delete($id)
    {
        PostTemplate::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function userCreatePost()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $pages = UserFacebookPage::where('user_id', $userId)->get();
        $scheduledPosts = ScheduledPost::join('user_facebook_pages', 'scheduled_posts.page_id', '=', 'user_facebook_pages.page_id')
            ->select('user_facebook_pages.page_name', 'user_facebook_pages.page_photo', 'scheduled_posts.*')
            ->where('scheduled_posts.user_id', $userId)
            ->where('scheduled_posts.platform', 'Facebook')
            ->orderBy('scheduled_posts.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('facebook.create-new-post', [
            'currentUser' => $currentUser,
            'pages' => $pages,
            'scheduledPosts' => $scheduledPosts,
            'data' => $data
        ]);
    }
}
