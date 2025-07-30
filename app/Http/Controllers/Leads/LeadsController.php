<?php

namespace App\Http\Controllers\Leads;

use App\Facebook\FacebookAccessToken;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\BlockedLead;
use App\Models\Country;
use App\Models\DailySave;
use App\Models\DailySearch;
use App\Models\DashboardCount;
use App\Models\Deals;
use App\Models\EmailCategory;
use App\Models\FacebookCategory;
use App\Models\FacebookUser;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadFile;
use App\Models\LeadGroup;
use App\Models\LeadNote;
use App\Models\LostReason;
use App\Models\LostReasonCount;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class LeadsController extends Controller
{
    private $accessToken;

    public function __construct()
    {
        $this->middleware('auth');
        $this->accessToken = new FacebookAccessToken();
    }

    public function index()
    {
        $userid = auth()->user()->id;

        $categories = FacebookCategory::all();
        $currentUser = User::findOrFail($userid);
        $pages = [];
        $notifications = $currentUser->notifications;
        $data = FacebookUser::where('user_id', $userid)->first();
        $organizations = Organization::whereNull('user_id')->get();
        $myorganizations = Organization::where('user_id', $userid)->get();

        return view('lead-pages.find-facebook-leads', [
            'currentUser' => $currentUser,
            'categories' => $categories,
            'pages' => $pages,
            'notifications' => $notifications,
            'data' => $data,
            'orgs' => $organizations,
            'myorgs' => $myorganizations
        ]);
    }

    public function leadList()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $leads = Lead::leftJoin('lead_groups', 'leads.lead_group_id', '=', 'lead_groups.id')
            ->leftJoin('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->leftJoin('organizations', 'leads.organization_id', '=', 'organizations.id')
            ->leftJoin('deals', 'leads.deal_id', '=', 'deals.id')
            ->select(
                'leads.id',
                'leads.lead_name',
                'leads.lead_photo',
                'leads.email',
                'leads.country',
                'leads.city',
                'leads.state',
                'leads.zip',
                'leads.street',
                'leads.link',
                'leads.linkedin',
                'leads.organization_id',
                'organizations.organization_name',
                'leads.website',
                'lead_groups.lead_group_name',
                'lead_classes.lead_class_name',
                'deals.deal_price'
            )
            ->where('leads.user_id', $userId)
            ->paginate(12);

        $emailcategory = EmailCategory::all();
        $notifications = $currentUser->notifications;
        $organizations = Organization::whereNull('user_id', null)->get();
        $myOrganizations = Organization::where('user_id', $userId)->get();
        $leadgroups = LeadGroup::where('user_id', null)->get();
        $myleadgroups = LeadGroup::where('user_id', $userId)->get();
        $dashCount = DashboardCount::where('user_id', $userId)->first();
        $reasons = LostReason::all();

        return view('lead-pages.lead-list', [
            'currentUser' => $currentUser,
            'leads' => $leads,
            'notifications' => $notifications,
            'organizations' => $organizations,
            'myOrganizations' => $myOrganizations,
            'leadgroups' => $leadgroups,
            'myleadgroups' => $myleadgroups,
            'emailcategory' => $emailcategory,
            'dashCount' => $dashCount,
            'data' => $data,
            'reasons' => $reasons,
        ]);
    }

    public function searchFilter(Request $request)
    {
        $userId = auth()->user()->id;
        $leads = Lead::leftJoin('lead_groups', 'leads.lead_group_id', '=', 'lead_groups.id')
            ->leftJoin('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->leftJoin('organizations', 'leads.organization_id', '=', 'organizations.id')
            ->leftJoin('deals', 'leads.deal_id', '=', 'deals.id')
            ->select(
                'leads.id',
                'leads.lead_name',
                'leads.email',
                'leads.country',
                'leads.city',
                'leads.state',
                'leads.zip',
                'leads.street',
                'leads.link',
                'leads.lead_photo',
                'deals.deal_title',
                'deals.deal_price',
                'leads.organization_id',
                'organizations.organization_name',
                'leads.website',
                'lead_groups.lead_group_name',
                'lead_classes.lead_class_name'
            )
            ->where('leads.user_id', $userId)
            ->where('leads.lead_name', 'like', '%' . $request->lead_name . '%')
            ->get();


        return $leads;
    }

    public function filterBy(Request $request)
    {
        $userId = auth()->user()->id;
        $query = Lead::query()
            ->leftJoin('lead_groups', 'leads.lead_group_id', '=', 'lead_groups.id')
            ->leftJoin('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->leftJoin('organizations', 'leads.organization_id', '=', 'organizations.id')
            ->leftJoin('deals', 'leads.deal_id', '=', 'deals.id')
            ->select(
                'leads.id',
                'leads.lead_name',
                'leads.email',
                'leads.country',
                'leads.city',
                'leads.lead_photo',
                'leads.state',
                'leads.zip',
                'leads.street',
                'leads.link',
                'deals.deal_title',
                'deals.deal_price',
                'leads.organization_id',
                'organizations.organization_name',
                'leads.website',
                'lead_groups.lead_group_name',
                'lead_classes.lead_class_name'
            )->where('leads.user_id', $userId);

        if ($request->has('withEmail')) {
            $query->whereNotNull('leads.email');
        }

        if ($request->has('groups')) {
            $query->where('leads.organization_id', $request->groups);
        }

        if ($request->has('pipelines')) {
            $query->where('leads.lead_group_id', $request->pipelines);
        }

        $leads = $query->get();

        return $leads;
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $currentDate = Carbon::now()->format('Y-m-d');
        $dailySave = DailySave::where('user_id', $userId)->where('date', $currentDate)->first();
        $userRole = DB::table('model_has_roles')
            ->where('model_id', $userId)
            ->where('model_type', 'App\Models\User')
            ->first();

        $role = Role::findOrFail($userRole->role_id);

        if ($role->name == 'Free') {
            if (!$dailySave || $dailySave->count < 10) {
                $token = $this->accessToken->pagePermissionAccessToken();

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://graph.facebook.com/' . $request->page_id . '?fields=emails,website,about,birthday,can_checkin,category,category_list,checkins,cover,display_subtext,fan_count,followers_count,has_transitioned_to_new_page_experience,hours,is_always_open,is_community_page,is_messenger_bot_get_started_enabled,is_messenger_platform_bot,is_owned,is_permanently_closed,is_published,is_unclaimed,verification_status,is_webhooks_subscribed,leadgen_tos_accepted,messenger_ads_default_icebreakers,overall_star_rating,place_type,price_range,rating_count,single_line_address,talking_about_count,temporary_status,username,were_here_count&access_token=' . $token);

                $data = json_decode($response);

                $imageResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://graph.facebook.com/' . $request->page_id . '/picture?type=large&redirect&access_token=' . $token);

                $image = json_decode($imageResponse)->data;

                $leads = new Lead();
                $leads->user_id = $userId;
                $leads->lead_group_id = 1;
                $leads->lead_id = $request->page_id;
                $leads->lead_name = $request->page_name;
                $leads->deal_id = 1;
                $leads->lead_photo = $image->url;
                $leads->organization_id = $request->leadgroups;
                $leads->email = isset($data->emails) ? json_encode($data->emails) : null;
                $leads->website = isset($data->website) ? $data->website : null;
                $leads->country = $request->page_country;
                $leads->city = $request->page_city;
                $leads->state = $request->page_state;
                $leads->zip = $request->page_zip;
                $leads->street = $request->page_street;
                $leads->link = $request->page_link;
                $leads->save();

                $leadDetails = new LeadDetail();
                $leadDetails->lead_id = $leads->id;
                $leadDetails->about = isset($data->about) ? $data->about : null;
                $leadDetails->birthday = isset($data->birthday) ? $data->birthday : null;
                $leadDetails->can_checkin = isset($data->can_checkin) ? $data->can_checkin : null;
                $leadDetails->category = isset($data->category) ? $data->category : null;
                $leadDetails->category_list = isset($data->category_list) ? json_encode($data->category_list) : null;
                $leadDetails->checkins = isset($data->checkins) ? $data->checkins : null;
                $leadDetails->cover = isset($data->cover) ? json_encode($data->cover) : null;
                $leadDetails->display_subtext = isset($data->display_subtext) ? $data->display_subtext : null;
                $leadDetails->fan_count = isset($data->fan_count) ? $data->fan_count : null;
                $leadDetails->followers_count = isset($data->followers_count) ? $data->followers_count : null;
                $leadDetails->has_transitioned_to_new_page_experience = isset($data->has_transitioned_to_new_page_experience) ? $data->has_transitioned_to_new_page_experience : null;
                $leadDetails->hours = isset($data->hours) ? json_encode($data->hours) : null;
                $leadDetails->is_always_open = isset($data->is_always_open) ? $data->is_always_open : null;
                $leadDetails->is_community_page = isset($data->is_community_page) ? $data->is_community_page : null;
                $leadDetails->is_messenger_bot_get_started_enabled = isset($data->is_messenger_bot_get_started_enabled) ? $data->is_messenger_bot_get_started_enabled : null;
                $leadDetails->is_messenger_platform_bot = isset($data->is_messenger_platform_bot) ? $data->is_messenger_platform_bot : null;
                $leadDetails->is_owned = isset($data->is_owned) ? $data->is_owned : null;
                $leadDetails->is_permanently_closed = isset($data->is_permanently_closed) ? $data->is_permanently_closed : null;
                $leadDetails->is_published = isset($data->is_published) ? $data->is_published : null;
                $leadDetails->is_unclaimed = isset($data->is_unclaimed) ? $data->is_unclaimed : null;
                $leadDetails->verification_status = isset($data->verification_status) ? $data->verification_status : null;
                $leadDetails->is_webhooks_subscribed = isset($data->is_webhooks_subscribed) ? $data->is_webhooks_subscribed : null;
                $leadDetails->leadgen_tos_accepted = isset($data->leadgen_tos_accepted) ? $data->leadgen_tos_accepted : null;
                $leadDetails->messenger_ads_default_icebreakers = isset($data->messenger_ads_default_icebreakers) ? json_encode($data->messenger_ads_default_icebreakers) : null;
                $leadDetails->overall_star_rating = isset($data->overall_star_rating) ? $data->overall_star_rating : null;
                $leadDetails->place_type = isset($data->place_type) ? $data->place_type : null;
                $leadDetails->price_range = isset($data->price_range) ? $data->price_range : null;
                $leadDetails->rating_count = isset($data->rating_count) ? $data->rating_count : null;
                $leadDetails->talking_about_count = isset($data->talking_about_count) ? $data->talking_about_count : null;
                $leadDetails->temporary_status = isset($data->temporary_status) ? $data->temporary_status : null;
                $leadDetails->username = isset($data->username) ? $data->username : null;
                $leadDetails->were_here_count = isset($data->were_here_count) ? $data->were_here_count : null;
                $leadDetails->save();

                if ($dailySave) {
                    $dailySave->count = $dailySave->count + 1;
                    $dailySave->save();
                } else {
                    $newSave = new DailySave();
                    $newSave->user_id = $userId;
                    $newSave->date = $currentDate;
                    $newSave->count = 1;
                    $newSave->save();
                }

                return $leads;
            }

            return 'You have reached the maximum allowed saved leads for today.';
        } else if ($role->name == 'Freelancer') {
            if ($dailySave || $dailySave->count < 50) {
                $token = $this->accessToken->pagePermissionAccessToken();

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://graph.facebook.com/' . $request->page_id . '?fields=emails,website,about,birthday,can_checkin,category,category_list,checkins,cover,display_subtext,fan_count,followers_count,has_transitioned_to_new_page_experience,hours,is_always_open,is_community_page,is_messenger_bot_get_started_enabled,is_messenger_platform_bot,is_owned,is_permanently_closed,is_published,is_unclaimed,verification_status,is_webhooks_subscribed,leadgen_tos_accepted,messenger_ads_default_icebreakers,overall_star_rating,place_type,price_range,rating_count,single_line_address,talking_about_count,temporary_status,username,were_here_count&access_token=' . $token);

                $data = json_decode($response);

                $imageResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://graph.facebook.com/' . $request->page_id . '/picture?type=large&redirect&access_token=' . $token);

                $image = json_decode($imageResponse)->data;

                $leads = new Lead();
                $leads->user_id = $userId;
                $leads->lead_group_id = 1;
                $leads->lead_id = $request->page_id;
                $leads->lead_name = $request->page_name;
                $leads->deal_id = 1;
                $leads->lead_photo = $image->url;
                $leads->organization_id = $request->leadgroups;
                $leads->email = isset($data->emails) ? json_encode($data->emails) : null;
                $leads->website = isset($data->website) ? $data->website : null;
                $leads->country = $request->page_country;
                $leads->city = $request->page_city;
                $leads->state = $request->page_state;
                $leads->zip = $request->page_zip;
                $leads->street = $request->page_street;
                $leads->link = $request->page_link;
                $leads->save();

                $leadDetails = new LeadDetail();
                $leadDetails->lead_id = $leads->id;
                $leadDetails->about = isset($data->about) ? $data->about : null;
                $leadDetails->birthday = isset($data->birthday) ? $data->birthday : null;
                $leadDetails->can_checkin = isset($data->can_checkin) ? $data->can_checkin : null;
                $leadDetails->category = isset($data->category) ? $data->category : null;
                $leadDetails->category_list = isset($data->category_list) ? json_encode($data->category_list) : null;
                $leadDetails->checkins = isset($data->checkins) ? $data->checkins : null;
                $leadDetails->cover = isset($data->cover) ? json_encode($data->cover) : null;
                $leadDetails->display_subtext = isset($data->display_subtext) ? $data->display_subtext : null;
                $leadDetails->fan_count = isset($data->fan_count) ? $data->fan_count : null;
                $leadDetails->followers_count = isset($data->followers_count) ? $data->followers_count : null;
                $leadDetails->has_transitioned_to_new_page_experience = isset($data->has_transitioned_to_new_page_experience) ? $data->has_transitioned_to_new_page_experience : null;
                $leadDetails->hours = isset($data->hours) ? json_encode($data->hours) : null;
                $leadDetails->is_always_open = isset($data->is_always_open) ? $data->is_always_open : null;
                $leadDetails->is_community_page = isset($data->is_community_page) ? $data->is_community_page : null;
                $leadDetails->is_messenger_bot_get_started_enabled = isset($data->is_messenger_bot_get_started_enabled) ? $data->is_messenger_bot_get_started_enabled : null;
                $leadDetails->is_messenger_platform_bot = isset($data->is_messenger_platform_bot) ? $data->is_messenger_platform_bot : null;
                $leadDetails->is_owned = isset($data->is_owned) ? $data->is_owned : null;
                $leadDetails->is_permanently_closed = isset($data->is_permanently_closed) ? $data->is_permanently_closed : null;
                $leadDetails->is_published = isset($data->is_published) ? $data->is_published : null;
                $leadDetails->is_unclaimed = isset($data->is_unclaimed) ? $data->is_unclaimed : null;
                $leadDetails->verification_status = isset($data->verification_status) ? $data->verification_status : null;
                $leadDetails->is_webhooks_subscribed = isset($data->is_webhooks_subscribed) ? $data->is_webhooks_subscribed : null;
                $leadDetails->leadgen_tos_accepted = isset($data->leadgen_tos_accepted) ? $data->leadgen_tos_accepted : null;
                $leadDetails->messenger_ads_default_icebreakers = isset($data->messenger_ads_default_icebreakers) ? json_encode($data->messenger_ads_default_icebreakers) : null;
                $leadDetails->overall_star_rating = isset($data->overall_star_rating) ? $data->overall_star_rating : null;
                $leadDetails->place_type = isset($data->place_type) ? $data->place_type : null;
                $leadDetails->price_range = isset($data->price_range) ? $data->price_range : null;
                $leadDetails->rating_count = isset($data->rating_count) ? $data->rating_count : null;
                $leadDetails->talking_about_count = isset($data->talking_about_count) ? $data->talking_about_count : null;
                $leadDetails->temporary_status = isset($data->temporary_status) ? $data->temporary_status : null;
                $leadDetails->username = isset($data->username) ? $data->username : null;
                $leadDetails->were_here_count = isset($data->were_here_count) ? $data->were_here_count : null;
                $leadDetails->save();

                if ($dailySave) {
                    $dailySave->count = $dailySave->count + 1;
                    $dailySave->save();
                } else {
                    $newSave = new DailySave();
                    $newSave->user_id = $userId;
                    $newSave->date = $currentDate;
                    $newSave->count = 1;
                    $newSave->save();
                }

                return $leads;
            }

            return 'You have reached the maximum allowed saved leads for today.';
        } else if ($role->name == 'Pro') {
            if (!$dailySave || $dailySave->count < 100) {
                $token = $this->accessToken->pagePermissionAccessToken();

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://graph.facebook.com/' . $request->page_id . '?fields=emails,website,about,birthday,can_checkin,category,category_list,checkins,cover,display_subtext,fan_count,followers_count,has_transitioned_to_new_page_experience,hours,is_always_open,is_community_page,is_messenger_bot_get_started_enabled,is_messenger_platform_bot,is_owned,is_permanently_closed,is_published,is_unclaimed,verification_status,is_webhooks_subscribed,leadgen_tos_accepted,messenger_ads_default_icebreakers,overall_star_rating,place_type,price_range,rating_count,single_line_address,talking_about_count,temporary_status,username,were_here_count&access_token=' . $token);

                $data = json_decode($response);

                $imageResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://graph.facebook.com/' . $request->page_id . '/picture?type=large&redirect&access_token=' . $token);

                $image = json_decode($imageResponse)->data;

                $leads = new Lead();
                $leads->user_id = $userId;
                $leads->lead_group_id = 1;
                $leads->lead_id = $request->page_id;
                $leads->lead_name = $request->page_name;
                $leads->deal_id = 1;
                $leads->lead_photo = $image->url;
                $leads->organization_id = $request->leadgroups;
                $leads->email = isset($data->emails) ? json_encode($data->emails) : null;
                $leads->website = isset($data->website) ? $data->website : null;
                $leads->country = $request->page_country;
                $leads->city = $request->page_city;
                $leads->state = $request->page_state;
                $leads->zip = $request->page_zip;
                $leads->street = $request->page_street;
                $leads->link = $request->page_link;
                $leads->save();

                $leadDetails = new LeadDetail();
                $leadDetails->lead_id = $leads->id;
                $leadDetails->about = isset($data->about) ? $data->about : null;
                $leadDetails->birthday = isset($data->birthday) ? $data->birthday : null;
                $leadDetails->can_checkin = isset($data->can_checkin) ? $data->can_checkin : null;
                $leadDetails->category = isset($data->category) ? $data->category : null;
                $leadDetails->category_list = isset($data->category_list) ? json_encode($data->category_list) : null;
                $leadDetails->checkins = isset($data->checkins) ? $data->checkins : null;
                $leadDetails->cover = isset($data->cover) ? json_encode($data->cover) : null;
                $leadDetails->display_subtext = isset($data->display_subtext) ? $data->display_subtext : null;
                $leadDetails->fan_count = isset($data->fan_count) ? $data->fan_count : null;
                $leadDetails->followers_count = isset($data->followers_count) ? $data->followers_count : null;
                $leadDetails->has_transitioned_to_new_page_experience = isset($data->has_transitioned_to_new_page_experience) ? $data->has_transitioned_to_new_page_experience : null;
                $leadDetails->hours = isset($data->hours) ? json_encode($data->hours) : null;
                $leadDetails->is_always_open = isset($data->is_always_open) ? $data->is_always_open : null;
                $leadDetails->is_community_page = isset($data->is_community_page) ? $data->is_community_page : null;
                $leadDetails->is_messenger_bot_get_started_enabled = isset($data->is_messenger_bot_get_started_enabled) ? $data->is_messenger_bot_get_started_enabled : null;
                $leadDetails->is_messenger_platform_bot = isset($data->is_messenger_platform_bot) ? $data->is_messenger_platform_bot : null;
                $leadDetails->is_owned = isset($data->is_owned) ? $data->is_owned : null;
                $leadDetails->is_permanently_closed = isset($data->is_permanently_closed) ? $data->is_permanently_closed : null;
                $leadDetails->is_published = isset($data->is_published) ? $data->is_published : null;
                $leadDetails->is_unclaimed = isset($data->is_unclaimed) ? $data->is_unclaimed : null;
                $leadDetails->verification_status = isset($data->verification_status) ? $data->verification_status : null;
                $leadDetails->is_webhooks_subscribed = isset($data->is_webhooks_subscribed) ? $data->is_webhooks_subscribed : null;
                $leadDetails->leadgen_tos_accepted = isset($data->leadgen_tos_accepted) ? $data->leadgen_tos_accepted : null;
                $leadDetails->messenger_ads_default_icebreakers = isset($data->messenger_ads_default_icebreakers) ? json_encode($data->messenger_ads_default_icebreakers) : null;
                $leadDetails->overall_star_rating = isset($data->overall_star_rating) ? $data->overall_star_rating : null;
                $leadDetails->place_type = isset($data->place_type) ? $data->place_type : null;
                $leadDetails->price_range = isset($data->price_range) ? $data->price_range : null;
                $leadDetails->rating_count = isset($data->rating_count) ? $data->rating_count : null;
                $leadDetails->talking_about_count = isset($data->talking_about_count) ? $data->talking_about_count : null;
                $leadDetails->temporary_status = isset($data->temporary_status) ? $data->temporary_status : null;
                $leadDetails->username = isset($data->username) ? $data->username : null;
                $leadDetails->were_here_count = isset($data->were_here_count) ? $data->were_here_count : null;
                $leadDetails->save();

                if ($dailySave) {
                    $dailySave->count = $dailySave->count + 1;
                    $dailySave->save();
                } else {
                    $newSave = new DailySave();
                    $newSave->user_id = $userId;
                    $newSave->date = $currentDate;
                    $newSave->count = 1;
                    $newSave->save();
                }

                return $leads;
            }

            return 'You have reached the maximum allowed saved leads for today.';
        } else {
            $token = $this->accessToken->pagePermissionAccessToken();

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get('https://graph.facebook.com/' . $request->page_id . '?fields=emails,website,about,birthday,can_checkin,category,category_list,checkins,cover,display_subtext,fan_count,followers_count,has_transitioned_to_new_page_experience,hours,is_always_open,is_community_page,is_messenger_bot_get_started_enabled,is_messenger_platform_bot,is_owned,is_permanently_closed,is_published,is_unclaimed,verification_status,is_webhooks_subscribed,leadgen_tos_accepted,messenger_ads_default_icebreakers,overall_star_rating,place_type,price_range,rating_count,single_line_address,talking_about_count,temporary_status,username,were_here_count&access_token=' . $token);

            $data = json_decode($response);

            $imageResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get('https://graph.facebook.com/' . $request->page_id . '/picture?type=large&redirect&access_token=' . $token);

            $image = json_decode($imageResponse)->data;

            $leads = new Lead();
            $leads->user_id = $userId;
            $leads->lead_group_id = 1;
            $leads->lead_id = $request->page_id;
            $leads->lead_name = $request->page_name;
            $leads->deal_id = 1;
            $leads->lead_photo = $image->url;
            $leads->organization_id = $request->leadgroups;
            $leads->email = isset($data->emails) ? json_encode($data->emails) : null;
            $leads->website = isset($data->website) ? $data->website : null;
            $leads->country = $request->page_country;
            $leads->city = $request->page_city;
            $leads->state = $request->page_state;
            $leads->zip = $request->page_zip;
            $leads->street = $request->page_street;
            $leads->link = $request->page_link;
            $leads->save();

            $leadDetails = new LeadDetail();
            $leadDetails->lead_id = $leads->id;
            $leadDetails->about = isset($data->about) ? $data->about : null;
            $leadDetails->birthday = isset($data->birthday) ? $data->birthday : null;
            $leadDetails->can_checkin = isset($data->can_checkin) ? $data->can_checkin : null;
            $leadDetails->category = isset($data->category) ? $data->category : null;
            $leadDetails->category_list = isset($data->category_list) ? json_encode($data->category_list) : null;
            $leadDetails->checkins = isset($data->checkins) ? $data->checkins : null;
            $leadDetails->cover = isset($data->cover) ? json_encode($data->cover) : null;
            $leadDetails->display_subtext = isset($data->display_subtext) ? $data->display_subtext : null;
            $leadDetails->fan_count = isset($data->fan_count) ? $data->fan_count : null;
            $leadDetails->followers_count = isset($data->followers_count) ? $data->followers_count : null;
            $leadDetails->has_transitioned_to_new_page_experience = isset($data->has_transitioned_to_new_page_experience) ? $data->has_transitioned_to_new_page_experience : null;
            $leadDetails->hours = isset($data->hours) ? json_encode($data->hours) : null;
            $leadDetails->is_always_open = isset($data->is_always_open) ? $data->is_always_open : null;
            $leadDetails->is_community_page = isset($data->is_community_page) ? $data->is_community_page : null;
            $leadDetails->is_messenger_bot_get_started_enabled = isset($data->is_messenger_bot_get_started_enabled) ? $data->is_messenger_bot_get_started_enabled : null;
            $leadDetails->is_messenger_platform_bot = isset($data->is_messenger_platform_bot) ? $data->is_messenger_platform_bot : null;
            $leadDetails->is_owned = isset($data->is_owned) ? $data->is_owned : null;
            $leadDetails->is_permanently_closed = isset($data->is_permanently_closed) ? $data->is_permanently_closed : null;
            $leadDetails->is_published = isset($data->is_published) ? $data->is_published : null;
            $leadDetails->is_unclaimed = isset($data->is_unclaimed) ? $data->is_unclaimed : null;
            $leadDetails->verification_status = isset($data->verification_status) ? $data->verification_status : null;
            $leadDetails->is_webhooks_subscribed = isset($data->is_webhooks_subscribed) ? $data->is_webhooks_subscribed : null;
            $leadDetails->leadgen_tos_accepted = isset($data->leadgen_tos_accepted) ? $data->leadgen_tos_accepted : null;
            $leadDetails->messenger_ads_default_icebreakers = isset($data->messenger_ads_default_icebreakers) ? json_encode($data->messenger_ads_default_icebreakers) : null;
            $leadDetails->overall_star_rating = isset($data->overall_star_rating) ? $data->overall_star_rating : null;
            $leadDetails->place_type = isset($data->place_type) ? $data->place_type : null;
            $leadDetails->price_range = isset($data->price_range) ? $data->price_range : null;
            $leadDetails->rating_count = isset($data->rating_count) ? $data->rating_count : null;
            $leadDetails->talking_about_count = isset($data->talking_about_count) ? $data->talking_about_count : null;
            $leadDetails->temporary_status = isset($data->temporary_status) ? $data->temporary_status : null;
            $leadDetails->username = isset($data->username) ? $data->username : null;
            $leadDetails->were_here_count = isset($data->were_here_count) ? $data->were_here_count : null;
            $leadDetails->save();

            return $leads;
        }
    }

    public function block(Request $request)
    {
        $userId = auth()->user()->id;

        $block = new BlockedLead();
        $block->user_id = $userId;
        $block->page_name = $request->page_name;
        $block->page_id = $request->page_id;
        $block->save();

        return true;
    }

    public function getPages(Request $request)
    {
        $userid = auth()->user()->id;
        $currentDate = Carbon::now()->format('Y-m-d');
        $searchCount = DailySearch::where('user_id', $userid)->where('date', $currentDate)->first();
        $userRole = DB::table('model_has_roles')
            ->where('model_id', $userid)
            ->where('model_type', 'App\Models\User')
            ->first();

        $userData = FacebookUser::where('user_id', $userid)->first();
        $role = Role::findOrFail($userRole->role_id);
        $token = $this->accessToken->getFacebookAccessToken();

        $currentUser = User::findOrFail($userid);
        $myleads = Lead::where('user_id', $userid)->pluck('lead_id');
        $blocked = BlockedLead::where('user_id', $userid)->pluck('page_id');
        $notifications = $currentUser->notifications;
        $categories = FacebookCategory::all();

        $organizations = Organization::whereNull('user_id')->get();
        $myorganizations = Organization::where('user_id', $userid)->get();

        if ($role->name == 'Free') {
            if (!$searchCount || $searchCount->count < 20) {

                $response = Http::get("https://graph.facebook.com/v17.0/pages/search?q={$request->category_name},{$request->keyword}&fields=id,name,location,link&access_token={$token}");

                $data = collect(json_decode($response)->data);

                $filteredData = $data->filter(function ($page) use ($myleads) {
                    return !$myleads->contains($page->id);
                });

                $cleanData = $filteredData->filter(function ($lead) use ($blocked) {
                    return !$blocked->contains($lead->id);
                });

                $page = request()->get('page', 1);
                $perPage = 20;
                $offset = ($page - 1) * $perPage;
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $cleanData->slice($offset, $perPage),
                    $cleanData->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );

                $dashCount = DashboardCount::where('user_id', $userid)->first();

                if ($dashCount) {
                    $dashCount->search_count = $dashCount->search_count + 20;
                    $dashCount->save();
                } else {
                    $newCount = new DashboardCount();
                    $newCount->user_id = $userid;
                    $newCount->search_count = 20;
                    $newCount->save();
                }

                if ($searchCount) {
                    $searchCount->count = $searchCount->count + 20;
                    $searchCount->save();
                } else {
                    $newSearch = new DailySearch();
                    $newSearch->user_id = $userid;
                    $newSearch->date = $currentDate;
                    $newSearch->count = 20;
                    $newSearch->save();
                }

                return view('lead-pages.find-facebook-leads', [
                    'categoryName' => $request->category_name,
                    'keyword' => $request->keyword,
                    'pages' => $paginator,
                    'categories' => $categories,
                    'currentUser' => $currentUser,
                    'notifications' => $notifications,
                    'data' => $userData,
                    'orgs' => $organizations,
                    'myorgs' => $myorganizations,
                ]);
            }

            Alert::error('Error', 'You have reached the maximum allowed search.');
            return redirect()->route('find-facebook-leads');
        } else if ($role->name == 'Freelancer') {
            if (!$searchCount || $searchCount->count < 500) {

                $response = Http::get("https://graph.facebook.com/v17.0/pages/search?q={$request->category_name},{$request->keyword}&fields=id,name,location,link&access_token={$token}");

                $data = collect(json_decode($response)->data);

                $filteredData = $data->filter(function ($page) use ($myleads) {
                    return !$myleads->contains($page->id);
                });

                $cleanData = $filteredData->filter(function ($lead) use ($blocked) {
                    return !$blocked->contains($lead->id);
                });

                $page = request()->get('page', 1);
                $perPage = 20;
                $offset = ($page - 1) * $perPage;
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $cleanData->slice($offset, $perPage),
                    $cleanData->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );

                $dashCount = DashboardCount::where('user_id', $userid)->first();

                if ($dashCount) {
                    $dashCount->search_count = $dashCount->search_count + 20;
                    $dashCount->save();
                } else {
                    $newCount = new DashboardCount();
                    $newCount->user_id = $userid;
                    $newCount->search_count = 20;
                    $newCount->save();
                }

                if ($searchCount) {
                    $searchCount->count = $searchCount->count + 20;
                    $searchCount->save();
                } else {
                    $newSearch = new DailySearch();
                    $newSearch->user_id = $userid;
                    $newSearch->date = $currentDate;
                    $newSearch->count = 20;
                    $newSearch->save();
                }

                return view('lead-pages.find-facebook-leads', [
                    'categoryName' => $request->category_name,
                    'keyword' => $request->keyword,
                    'pages' => $paginator,
                    'categories' => $categories,
                    'currentUser' => $currentUser,
                    'notifications' => $notifications,
                    'data' => $userData,
                    'orgs' => $organizations,
                    'myorgs' => $myorganizations,
                ]);
            }

            Alert::error('Error', 'You have reached the maximum allowed search.');
            return redirect()->route('find-facebook-leads');
        } else if ($role->name == 'Pro') {
            if (!$searchCount || $searchCount->count < 1000) {

                $response = Http::get("https://graph.facebook.com/v17.0/pages/search?q={$request->category_name},{$request->keyword}&fields=id,name,location,link&access_token={$token}");

                $data = collect(json_decode($response)->data);

                $filteredData = $data->filter(function ($page) use ($myleads) {
                    return !$myleads->contains($page->id);
                });

                $cleanData = $filteredData->filter(function ($lead) use ($blocked) {
                    return !$blocked->contains($lead->id);
                });

                $page = request()->get('page', 1);
                $perPage = 20;
                $offset = ($page - 1) * $perPage;
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $cleanData->slice($offset, $perPage),
                    $cleanData->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );

                $dashCount = DashboardCount::where('user_id', $userid)->first();

                if ($dashCount) {
                    $dashCount->search_count = $dashCount->search_count + 20;
                    $dashCount->save();
                } else {
                    $newCount = new DashboardCount();
                    $newCount->user_id = $userid;
                    $newCount->search_count = 20;
                    $newCount->save();
                }

                if ($searchCount) {
                    $searchCount->count = $searchCount->count + 20;
                    $searchCount->save();
                } else {
                    $newSearch = new DailySearch();
                    $newSearch->user_id = $userid;
                    $newSearch->date = $currentDate;
                    $newSearch->count = 20;
                    $newSearch->save();
                }

                return view('lead-pages.find-facebook-leads', [
                    'categoryName' => $request->category_name,
                    'keyword' => $request->keyword,
                    'pages' => $paginator,
                    'categories' => $categories,
                    'currentUser' => $currentUser,
                    'notifications' => $notifications,
                    'data' => $userData,
                    'orgs' => $organizations,
                    'myorgs' => $myorganizations,
                ]);
            }

            Alert::error('Error', 'You have reached the maximum allowed search.');
            return redirect()->route('find-facebook-leads');
        } else {

            $response = Http::get("https://graph.facebook.com/v17.0/pages/search?q={$request->category_name},{$request->keyword}&fields=id,name,location,link&access_token={$token}");

            $data = collect(json_decode($response)->data);

            $filteredData = $data->filter(function ($page) use ($myleads) {
                return !$myleads->contains($page->id);
            });

            $cleanData = $filteredData->filter(function ($lead) use ($blocked) {
                return !$blocked->contains($lead->id);
            });

            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $cleanData->slice($offset, $perPage),
                $cleanData->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            $dashCount = DashboardCount::where('user_id', $userid)->first();

            if ($dashCount) {
                $dashCount->search_count = $dashCount->search_count + 20;
                $dashCount->save();
            } else {
                $newCount = new DashboardCount();
                $newCount->user_id = $userid;
                $newCount->search_count = 20;
                $newCount->save();
            }

            if ($searchCount) {
                $searchCount->count = $searchCount->count + 20;
                $searchCount->save();
            } else {
                $newSearch = new DailySearch();
                $newSearch->user_id = $userid;
                $newSearch->date = $currentDate;
                $newSearch->count = 20;
                $newSearch->save();
            }

            return view('lead-pages.find-facebook-leads', [
                'categoryName' => $request->category_name,
                'keyword' => $request->keyword,
                'pages' => $paginator,
                'categories' => $categories,
                'currentUser' => $currentUser,
                'notifications' => $notifications,
                'data' => $userData,
                'orgs' => $organizations,
                'myorgs' => $myorganizations,
            ]);
        }
    }

    public function show(string $id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $lead = Lead::leftJoin('lead_groups', 'leads.lead_group_id', '=', 'lead_groups.id')
            ->leftJoin('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->leftJoin('organizations', 'leads.organization_id', '=', 'organizations.id')
            ->leftJoin('lead_groups as leadgroups', 'organizations.lead_group_id', '=', 'leadgroups.id')
            ->leftJoin('lead_classes as leadclasses', 'leadgroups.class_id', '=', 'leadclasses.id')
            ->leftJoin('deals', 'leads.deal_id', '=', 'deals.id')
            ->select(
                'leads.id',
                'leads.lead_name',
                'leads.lead_photo',
                'leads.email',
                'leads.country',
                'leads.city',
                'leads.state',
                'leads.zip',
                'leads.street',
                'leads.created_at',
                'leads.linkedin',
                'leads.website',
                'lead_groups.lead_group_name',
                'lead_classes.lead_class_name',
                'organizations.organization_name',
                'leadgroups.lead_group_name as leadgroupname',
                'leadclasses.lead_class_name as leadclassname',
                'deals.deal_title'
            )
            ->where('leads.id', $id)
            ->first();

        $details = LeadDetail::where('lead_id', $lead->id)->first();

        $pendingActivities = Activity::where('lead_id', $lead->id)->where('status', 'Pending')->get();
        $doneActivities = Activity::where('lead_id', $lead->id)->where('status', 'Done')->get();
        $leadgroups = LeadGroup::where('user_id', null)->whereNot('lead_group_name', 'LOST')->get();
        $myleadgroups = LeadGroup::where('user_id', $userId)->get();
        $organizations = Organization::whereNull('user_id')->get();
        $myorganizations = Organization::where('user_id', $userId)->get();
        $leadfiles = LeadFile::where('lead_id', $lead->id)->get();
        $leadnotes = LeadNote::where('lead_id', $lead->id)->get();
        $countries = Country::all();
        $deals = Deals::where('user_id', null)->get();
        $mydeals = Deals::where('user_id', $userId)->get();
        $reasons = LostReason::all();

        $notifications = $currentUser->notifications;

        return view('lead-pages.lead-profile', [
            'currentUser' => $currentUser,
            'lead' => $lead,
            'leadgroups' => $leadgroups,
            'myleadgroups' => $myleadgroups,
            'myorganizations' => $myorganizations,
            'organizations' => $organizations,
            'pendingActivities' => isset($pendingActivities) ? $pendingActivities : null,
            'doneActivities' => isset($doneActivities) ? $doneActivities : null,
            'countries' => $countries,
            'leadfiles' => $leadfiles,
            'leadnotes' => $leadnotes,
            'notifications' => $notifications,
            'deals' => $deals,
            'mydeals' => $mydeals,
            'reasons' => $reasons,
            'details' => $details,
            'data' => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->lead_name = isset($request->lead_name) ? $request->lead_name : $lead->lead_name;
        $lead->email = isset($request->lead_email) ? json_encode($request->lead_email) : $lead->email;
        $lead->organization_id = isset($request->organizations) ? $request->organizations : $lead->organization_id;
        $lead->deal_id = isset($request->deals) ? $request->deals : $lead->deal_id;
        $lead->lead_group_id = isset($request->leadgroups) ? $request->leadgroups : $lead->lead_group_id;
        $lead->save();

        return redirect()->back();
    }

    public function updateLeadGroup(Request $request, string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->lead_group_id = $request->leads_id;
        $lead->save();

        return $lead;
    }

    public function updateAddress(Request $request, string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->country = isset($request->country) ? $request->country : $lead->country;
        $lead->city = isset($request->city) ? $request->city : $lead->city;
        $lead->state = isset($request->state) ? $request->state : $lead->state;
        $lead->zip = isset($request->zip) ? $request->zip : $lead->zip;
        $lead->street = isset($request->street) ? $request->street : $lead->street;
        $lead->save();

        return redirect()->back();
    }

    public function getLeadEmailPage(string $id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $lead = Lead::leftJoin('lead_groups', 'leads.lead_group_id', '=', 'lead_groups.id')
            ->leftJoin('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->leftJoin('organizations', 'leads.organization_id', '=', 'organizations.id')
            ->leftJoin('lead_groups as leadgroups', 'organizations.lead_group_id', '=', 'leadgroups.id')
            ->leftJoin('lead_classes as leadclasses', 'leadgroups.class_id', '=', 'leadclasses.id')
            ->select(
                'leads.id',
                'leads.lead_name',
                'leads.lead_photo',
                'leads.email',
                'leads.created_at',
                'lead_groups.lead_group_name',
                'lead_classes.lead_class_name',
                'organizations.organization_name',
                'leadclasses.lead_class_name as leadclassname',
            )
            ->where('leads.id', $id)
            ->first();

        $emailcategories = EmailCategory::all();

        return view('lead-pages.lead-email', [
            'currentUser' => $currentUser,
            'lead' => $lead,
            'emailcategories' => $emailcategories,
            'data' => $data
        ]);
    }

    public function updateSingleStage(Request $request)
    {
        $lead = Lead::findOrFail($request->leadid);
        $lead->lead_group_id = $request->stage;
        $lead->save();

        if ($request->reason) {
            $count = LostReasonCount::where('lost_reason_id', $request->reason)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!$count) {
                $reasonCount = new LostReasonCount();
                $reasonCount->user_id = auth()->user()->id;
                $reasonCount->lost_reason_id = $request->reason;
                $reasonCount->count = 1;
                $reasonCount->save();
            } else {
                $count->count = $count->count + 1;
                $count->save();
            }
        }


        Alert::success('Success', 'Lead stage has been successfully updated.');

        return redirect()->back();
    }

    public function updateStage(Request $request)
    {
        $leadIds = $request->secretToken;
        $leads = Lead::whereIn('id', $leadIds)->get();

        foreach ($leads as $lead) {
            $lead->lead_group_id = $request->lead_group_id;
            $lead->save();
        }

        if ($request->reason) {
            $count = LostReasonCount::where('lost_reason_id', $request->reason)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!$count) {
                $reasonCount = new LostReasonCount();
                $reasonCount->user_id = auth()->user()->id;
                $reasonCount->lost_reason_id = $request->reason;
                $reasonCount->count = count($leadIds);
                $reasonCount->save();
            } else {
                $count->count = $count->count + count($leadIds);
                $count->save();
            }
        }

        return true;
    }

    public function contactCount()
    {
        $userId = auth()->user()->id;

        $contactCount = DashboardCount::where('user_id', $userId)->first();
        if ($contactCount) {
            $contactCount->contact_count = $contactCount->contact_count + 1;
            $contactCount->save();
        } else {
            $newContactCount = new DashboardCount();
            $newContactCount->user_id = $userId;
            $newContactCount->contact_count = 1;
            $newContactCount->save();
        }

        return response()->json(true);
    }

    public function exportToCsv(Request $request)
    {
        $leadIds = $request->secretToken;

        $data = Lead::whereIn('id', $leadIds)->get();

        // create CSV file
        $filename = '2xMyLeads.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('ID', 'Name', 'Email', 'Website', 'Country', 'City', 'State', 'Zip', 'Street', 'Link'));
        foreach ($data as $row) {
            fputcsv($handle, array(
                $row->lead_id,
                $row->lead_name,
                isset($row->email) ? str_replace(array('[', ']', '"'), '', $row->email) : null,
                isset($row->website) ? $row->website : null,
                isset($row->country) ? $row->country : null,
                isset($row->city) ? $row->city : null,
                isset($row->state) ? $row->state : null,
                isset($row->zip) ? $row->zip : null,
                isset($row->street) ? $row->street : null,
                isset($row->link) ? $row->link : null
            ));
        }
        fclose($handle);

        // download CSV file
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        if ($request->ajax()) {
            return Response::make(file_get_contents($filename), 200, $headers);
        } else {
            return Response::download($filename, $filename, $headers);
        }
    }

    public function saveBulkLeads(Request $request)
    {
        $pageIds = $request->pageTokens;

        $userId = auth()->user()->id;
        $currentDate = Carbon::now()->format('Y-m-d');
        $dailySave = DailySave::where('user_id', $userId)->where('date', $currentDate)->first();

        $userRole = DB::table('model_has_roles')
            ->where('model_id', $userId)
            ->where('model_type', 'App\Models\User')
            ->first();

        $dailyCount = isset($dailySave) ? $dailySave->count : 0;

        $role = Role::findOrFail($userRole->role_id);
        $total = intval($dailyCount) + count($pageIds);
        $token = $this->accessToken->pagePermissionAccessToken();

        if ($role->name == 'Free') {
            if (count($pageIds) > 10) {
                return 'You can only select up to 10 leads within your current subscription tier.';
            } else if (!$dailySave || $total <= 10) {
                for ($i = 0; $i < count($pageIds); $i++) {

                    $subArray = explode(',', $pageIds[$i]);

                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->get('https://graph.facebook.com/' . $subArray[0] . '?fields=emails,website,about,birthday,can_checkin,category,category_list,checkins,cover,display_subtext,fan_count,followers_count,has_transitioned_to_new_page_experience,hours,is_always_open,is_community_page,is_messenger_bot_get_started_enabled,is_messenger_platform_bot,is_owned,is_permanently_closed,is_published,is_unclaimed,verification_status,is_webhooks_subscribed,leadgen_tos_accepted,messenger_ads_default_icebreakers,overall_star_rating,place_type,price_range,rating_count,single_line_address,talking_about_count,temporary_status,username,were_here_count&access_token=' . $token);

                    $data = json_decode($response);

                    $imageResponse = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->get('https://graph.facebook.com/' . $subArray[0] . '/picture?type=large&redirect&access_token=' . $token);

                    $image = json_decode($imageResponse)->data;

                    $leads = new Lead();
                    $leads->user_id = $userId;
                    $leads->lead_group_id = 1;
                    $leads->lead_id = $subArray[0];
                    $leads->lead_name = $subArray[1];
                    $leads->deal_id = 1;
                    $leads->lead_photo = $image->url;
                    $leads->organization_id = $request->leadgroup;
                    $leads->email = isset($data->emails) ? json_encode($data->emails) : null;
                    $leads->website = isset($data->website) ? $data->website : null;
                    $leads->country = $subArray[2];
                    $leads->city = $subArray[3];
                    $leads->state = $subArray[4];
                    $leads->zip = $subArray[5];
                    $leads->street = $subArray[6];
                    $leads->link = $subArray[7];
                    $leads->save();

                    $leadDetails = new LeadDetail();
                    $leadDetails->lead_id = $leads->id;
                    $leadDetails->about = isset($data->about) ? $data->about : null;
                    $leadDetails->birthday = isset($data->birthday) ? $data->birthday : null;
                    $leadDetails->can_checkin = isset($data->can_checkin) ? $data->can_checkin : null;
                    $leadDetails->category = isset($data->category) ? $data->category : null;
                    $leadDetails->category_list = isset($data->category_list) ? json_encode($data->category_list) : null;
                    $leadDetails->checkins = isset($data->checkins) ? $data->checkins : null;
                    $leadDetails->cover = isset($data->cover) ? json_encode($data->cover) : null;
                    $leadDetails->display_subtext = isset($data->display_subtext) ? $data->display_subtext : null;
                    $leadDetails->fan_count = isset($data->fan_count) ? $data->fan_count : null;
                    $leadDetails->followers_count = isset($data->followers_count) ? $data->followers_count : null;
                    $leadDetails->has_transitioned_to_new_page_experience = isset($data->has_transitioned_to_new_page_experience) ? $data->has_transitioned_to_new_page_experience : null;
                    $leadDetails->hours = isset($data->hours) ? json_encode($data->hours) : null;
                    $leadDetails->is_always_open = isset($data->is_always_open) ? $data->is_always_open : null;
                    $leadDetails->is_community_page = isset($data->is_community_page) ? $data->is_community_page : null;
                    $leadDetails->is_messenger_bot_get_started_enabled = isset($data->is_messenger_bot_get_started_enabled) ? $data->is_messenger_bot_get_started_enabled : null;
                    $leadDetails->is_messenger_platform_bot = isset($data->is_messenger_platform_bot) ? $data->is_messenger_platform_bot : null;
                    $leadDetails->is_owned = isset($data->is_owned) ? $data->is_owned : null;
                    $leadDetails->is_permanently_closed = isset($data->is_permanently_closed) ? $data->is_permanently_closed : null;
                    $leadDetails->is_published = isset($data->is_published) ? $data->is_published : null;
                    $leadDetails->is_unclaimed = isset($data->is_unclaimed) ? $data->is_unclaimed : null;
                    $leadDetails->verification_status = isset($data->verification_status) ? $data->verification_status : null;
                    $leadDetails->is_webhooks_subscribed = isset($data->is_webhooks_subscribed) ? $data->is_webhooks_subscribed : null;
                    $leadDetails->leadgen_tos_accepted = isset($data->leadgen_tos_accepted) ? $data->leadgen_tos_accepted : null;
                    $leadDetails->messenger_ads_default_icebreakers = isset($data->messenger_ads_default_icebreakers) ? json_encode($data->messenger_ads_default_icebreakers) : null;
                    $leadDetails->overall_star_rating = isset($data->overall_star_rating) ? $data->overall_star_rating : null;
                    $leadDetails->place_type = isset($data->place_type) ? $data->place_type : null;
                    $leadDetails->price_range = isset($data->price_range) ? $data->price_range : null;
                    $leadDetails->rating_count = isset($data->rating_count) ? $data->rating_count : null;
                    $leadDetails->talking_about_count = isset($data->talking_about_count) ? $data->talking_about_count : null;
                    $leadDetails->temporary_status = isset($data->temporary_status) ? $data->temporary_status : null;
                    $leadDetails->username = isset($data->username) ? $data->username : null;
                    $leadDetails->were_here_count = isset($data->were_here_count) ? $data->were_here_count : null;
                    $leadDetails->save();
                }

                if ($dailySave) {
                    $dailySave->count = $dailySave->count + count($pageIds);
                    $dailySave->save();
                } else {
                    $newSave = new DailySave();
                    $newSave->user_id = $userId;
                    $newSave->date = $currentDate;
                    $newSave->count = $total;
                    $newSave->save();
                }

                return $leads;
            }

            return 'You have reached the maximum allowed saved leads for today.';
        } else if ($role->name == 'Freelancer') {
            if (!$dailySave || $total <= 50) {
                for ($i = 0; $i < count($pageIds); $i++) {

                    $subArray = explode(',', $pageIds[$i]);

                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->get('https://graph.facebook.com/' . $subArray[0] . '?fields=emails,website,about,birthday,can_checkin,category,category_list,checkins,cover,display_subtext,fan_count,followers_count,has_transitioned_to_new_page_experience,hours,is_always_open,is_community_page,is_messenger_bot_get_started_enabled,is_messenger_platform_bot,is_owned,is_permanently_closed,is_published,is_unclaimed,verification_status,is_webhooks_subscribed,leadgen_tos_accepted,messenger_ads_default_icebreakers,overall_star_rating,place_type,price_range,rating_count,single_line_address,talking_about_count,temporary_status,username,were_here_count&access_token=' . $token);

                    $data = json_decode($response);

                    $imageResponse = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->get('https://graph.facebook.com/' . $subArray[0] . '/picture?type=large&redirect&access_token=' . $token);

                    $image = json_decode($imageResponse)->data;

                    $leads = new Lead();
                    $leads->user_id = $userId;
                    $leads->lead_group_id = 1;
                    $leads->lead_id = $subArray[0];
                    $leads->lead_name = $subArray[1];
                    $leads->deal_id = 1;
                    $leads->lead_photo = $image->url;
                    $leads->organization_id = $request->leadgroup;
                    $leads->email = isset($data->emails) ? json_encode($data->emails) : null;
                    $leads->website = isset($data->website) ? $data->website : null;
                    $leads->country = $subArray[2];
                    $leads->city = $subArray[3];
                    $leads->state = $subArray[4];
                    $leads->zip = $subArray[5];
                    $leads->street = $subArray[6];
                    $leads->link = $subArray[7];
                    $leads->save();

                    $leadDetails = new LeadDetail();
                    $leadDetails->lead_id = $leads->id;
                    $leadDetails->about = isset($data->about) ? $data->about : null;
                    $leadDetails->birthday = isset($data->birthday) ? $data->birthday : null;
                    $leadDetails->can_checkin = isset($data->can_checkin) ? $data->can_checkin : null;
                    $leadDetails->category = isset($data->category) ? $data->category : null;
                    $leadDetails->category_list = isset($data->category_list) ? json_encode($data->category_list) : null;
                    $leadDetails->checkins = isset($data->checkins) ? $data->checkins : null;
                    $leadDetails->cover = isset($data->cover) ? json_encode($data->cover) : null;
                    $leadDetails->display_subtext = isset($data->display_subtext) ? $data->display_subtext : null;
                    $leadDetails->fan_count = isset($data->fan_count) ? $data->fan_count : null;
                    $leadDetails->followers_count = isset($data->followers_count) ? $data->followers_count : null;
                    $leadDetails->has_transitioned_to_new_page_experience = isset($data->has_transitioned_to_new_page_experience) ? $data->has_transitioned_to_new_page_experience : null;
                    $leadDetails->hours = isset($data->hours) ? json_encode($data->hours) : null;
                    $leadDetails->is_always_open = isset($data->is_always_open) ? $data->is_always_open : null;
                    $leadDetails->is_community_page = isset($data->is_community_page) ? $data->is_community_page : null;
                    $leadDetails->is_messenger_bot_get_started_enabled = isset($data->is_messenger_bot_get_started_enabled) ? $data->is_messenger_bot_get_started_enabled : null;
                    $leadDetails->is_messenger_platform_bot = isset($data->is_messenger_platform_bot) ? $data->is_messenger_platform_bot : null;
                    $leadDetails->is_owned = isset($data->is_owned) ? $data->is_owned : null;
                    $leadDetails->is_permanently_closed = isset($data->is_permanently_closed) ? $data->is_permanently_closed : null;
                    $leadDetails->is_published = isset($data->is_published) ? $data->is_published : null;
                    $leadDetails->is_unclaimed = isset($data->is_unclaimed) ? $data->is_unclaimed : null;
                    $leadDetails->verification_status = isset($data->verification_status) ? $data->verification_status : null;
                    $leadDetails->is_webhooks_subscribed = isset($data->is_webhooks_subscribed) ? $data->is_webhooks_subscribed : null;
                    $leadDetails->leadgen_tos_accepted = isset($data->leadgen_tos_accepted) ? $data->leadgen_tos_accepted : null;
                    $leadDetails->messenger_ads_default_icebreakers = isset($data->messenger_ads_default_icebreakers) ? json_encode($data->messenger_ads_default_icebreakers) : null;
                    $leadDetails->overall_star_rating = isset($data->overall_star_rating) ? $data->overall_star_rating : null;
                    $leadDetails->place_type = isset($data->place_type) ? $data->place_type : null;
                    $leadDetails->price_range = isset($data->price_range) ? $data->price_range : null;
                    $leadDetails->rating_count = isset($data->rating_count) ? $data->rating_count : null;
                    $leadDetails->talking_about_count = isset($data->talking_about_count) ? $data->talking_about_count : null;
                    $leadDetails->temporary_status = isset($data->temporary_status) ? $data->temporary_status : null;
                    $leadDetails->username = isset($data->username) ? $data->username : null;
                    $leadDetails->were_here_count = isset($data->were_here_count) ? $data->were_here_count : null;
                    $leadDetails->save();
                }

                if ($dailySave) {
                    $dailySave->count = $dailySave->count + count($pageIds);
                    $dailySave->save();
                } else {
                    $newSave = new DailySave();
                    $newSave->user_id = $userId;
                    $newSave->date = $currentDate;
                    $newSave->count = $total;
                    $newSave->save();
                }
                return $leads;
            }

            return 'You have reached the maximum allowed saved leads for today.';
        } else if ($role->name == 'Pro') {
            if (!$dailySave || $total <= 100) {
                for ($i = 0; $i < count($pageIds); $i++) {

                    $subArray = explode(',', $pageIds[$i]);

                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->get('https://graph.facebook.com/' . $subArray[0] . '?fields=emails,website,about,birthday,can_checkin,category,category_list,checkins,cover,display_subtext,fan_count,followers_count,has_transitioned_to_new_page_experience,hours,is_always_open,is_community_page,is_messenger_bot_get_started_enabled,is_messenger_platform_bot,is_owned,is_permanently_closed,is_published,is_unclaimed,verification_status,is_webhooks_subscribed,leadgen_tos_accepted,messenger_ads_default_icebreakers,overall_star_rating,place_type,price_range,rating_count,single_line_address,talking_about_count,temporary_status,username,were_here_count&access_token=' . $token);

                    $data = json_decode($response);

                    $imageResponse = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->get('https://graph.facebook.com/' . $subArray[0] . '/picture?type=large&redirect&access_token=' . $token);

                    $image = json_decode($imageResponse)->data;

                    $leads = new Lead();
                    $leads->user_id = $userId;
                    $leads->lead_group_id = 1;
                    $leads->lead_id = $subArray[0];
                    $leads->lead_name = $subArray[1];
                    $leads->deal_id = 1;
                    $leads->lead_photo = $image->url;
                    $leads->organization_id = $request->leadgroup;
                    $leads->email = isset($data->emails) ? json_encode($data->emails) : null;
                    $leads->website = isset($data->website) ? $data->website : null;
                    $leads->country = $subArray[2];
                    $leads->city = $subArray[3];
                    $leads->state = $subArray[4];
                    $leads->zip = $subArray[5];
                    $leads->street = $subArray[6];
                    $leads->link = $subArray[7];
                    $leads->save();

                    $leadDetails = new LeadDetail();
                    $leadDetails->lead_id = $leads->id;
                    $leadDetails->about = isset($data->about) ? $data->about : null;
                    $leadDetails->birthday = isset($data->birthday) ? $data->birthday : null;
                    $leadDetails->can_checkin = isset($data->can_checkin) ? $data->can_checkin : null;
                    $leadDetails->category = isset($data->category) ? $data->category : null;
                    $leadDetails->category_list = isset($data->category_list) ? json_encode($data->category_list) : null;
                    $leadDetails->checkins = isset($data->checkins) ? $data->checkins : null;
                    $leadDetails->cover = isset($data->cover) ? json_encode($data->cover) : null;
                    $leadDetails->display_subtext = isset($data->display_subtext) ? $data->display_subtext : null;
                    $leadDetails->fan_count = isset($data->fan_count) ? $data->fan_count : null;
                    $leadDetails->followers_count = isset($data->followers_count) ? $data->followers_count : null;
                    $leadDetails->has_transitioned_to_new_page_experience = isset($data->has_transitioned_to_new_page_experience) ? $data->has_transitioned_to_new_page_experience : null;
                    $leadDetails->hours = isset($data->hours) ? json_encode($data->hours) : null;
                    $leadDetails->is_always_open = isset($data->is_always_open) ? $data->is_always_open : null;
                    $leadDetails->is_community_page = isset($data->is_community_page) ? $data->is_community_page : null;
                    $leadDetails->is_messenger_bot_get_started_enabled = isset($data->is_messenger_bot_get_started_enabled) ? $data->is_messenger_bot_get_started_enabled : null;
                    $leadDetails->is_messenger_platform_bot = isset($data->is_messenger_platform_bot) ? $data->is_messenger_platform_bot : null;
                    $leadDetails->is_owned = isset($data->is_owned) ? $data->is_owned : null;
                    $leadDetails->is_permanently_closed = isset($data->is_permanently_closed) ? $data->is_permanently_closed : null;
                    $leadDetails->is_published = isset($data->is_published) ? $data->is_published : null;
                    $leadDetails->is_unclaimed = isset($data->is_unclaimed) ? $data->is_unclaimed : null;
                    $leadDetails->verification_status = isset($data->verification_status) ? $data->verification_status : null;
                    $leadDetails->is_webhooks_subscribed = isset($data->is_webhooks_subscribed) ? $data->is_webhooks_subscribed : null;
                    $leadDetails->leadgen_tos_accepted = isset($data->leadgen_tos_accepted) ? $data->leadgen_tos_accepted : null;
                    $leadDetails->messenger_ads_default_icebreakers = isset($data->messenger_ads_default_icebreakers) ? json_encode($data->messenger_ads_default_icebreakers) : null;
                    $leadDetails->overall_star_rating = isset($data->overall_star_rating) ? $data->overall_star_rating : null;
                    $leadDetails->place_type = isset($data->place_type) ? $data->place_type : null;
                    $leadDetails->price_range = isset($data->price_range) ? $data->price_range : null;
                    $leadDetails->rating_count = isset($data->rating_count) ? $data->rating_count : null;
                    $leadDetails->talking_about_count = isset($data->talking_about_count) ? $data->talking_about_count : null;
                    $leadDetails->temporary_status = isset($data->temporary_status) ? $data->temporary_status : null;
                    $leadDetails->username = isset($data->username) ? $data->username : null;
                    $leadDetails->were_here_count = isset($data->were_here_count) ? $data->were_here_count : null;
                    $leadDetails->save();

                    if ($dailySave) {
                        $dailySave->count = $dailySave->count + count($pageIds);
                        $dailySave->save();
                    } else {
                        $newSave = new DailySave();
                        $newSave->user_id = $userId;
                        $newSave->date = $currentDate;
                        $newSave->count = $total;
                        $newSave->save();
                    }
                }
                return $leads;
            }

            return 'You have reached the maximum allowed saved leads for today.';
        } else {
            for ($i = 0; $i < count($pageIds); $i++) {

                $subArray = explode(',', $pageIds[$i]);

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://graph.facebook.com/' . $subArray[0] . '?fields=emails,website,about,birthday,can_checkin,category,category_list,checkins,cover,display_subtext,fan_count,followers_count,has_transitioned_to_new_page_experience,hours,is_always_open,is_community_page,is_messenger_bot_get_started_enabled,is_messenger_platform_bot,is_owned,is_permanently_closed,is_published,is_unclaimed,verification_status,is_webhooks_subscribed,leadgen_tos_accepted,messenger_ads_default_icebreakers,overall_star_rating,place_type,price_range,rating_count,single_line_address,talking_about_count,temporary_status,username,were_here_count&access_token=' . $token);

                $data = json_decode($response);

                $imageResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://graph.facebook.com/' . $subArray[0] . '/picture?type=large&redirect&access_token=' . $token);

                $image = json_decode($imageResponse)->data;

                $leads = new Lead();
                $leads->user_id = $userId;
                $leads->lead_group_id = 1;
                $leads->lead_id = $subArray[0];
                $leads->lead_name = $subArray[1];
                $leads->deal_id = 1;
                $leads->lead_photo = $image->url;
                $leads->organization_id = $request->leadgroup;
                $leads->email = isset($data->emails) ? json_encode($data->emails) : null;
                $leads->website = isset($data->website) ? $data->website : null;
                $leads->country = $subArray[2];
                $leads->city = $subArray[3];
                $leads->state = $subArray[4];
                $leads->zip = $subArray[5];
                $leads->street = $subArray[6];
                $leads->link = $subArray[7];
                $leads->save();

                $leadDetails = new LeadDetail();
                $leadDetails->lead_id = $leads->id;
                $leadDetails->about = isset($data->about) ? $data->about : null;
                $leadDetails->birthday = isset($data->birthday) ? $data->birthday : null;
                $leadDetails->can_checkin = isset($data->can_checkin) ? $data->can_checkin : null;
                $leadDetails->category = isset($data->category) ? $data->category : null;
                $leadDetails->category_list = isset($data->category_list) ? json_encode($data->category_list) : null;
                $leadDetails->checkins = isset($data->checkins) ? $data->checkins : null;
                $leadDetails->cover = isset($data->cover) ? json_encode($data->cover) : null;
                $leadDetails->display_subtext = isset($data->display_subtext) ? $data->display_subtext : null;
                $leadDetails->fan_count = isset($data->fan_count) ? $data->fan_count : null;
                $leadDetails->followers_count = isset($data->followers_count) ? $data->followers_count : null;
                $leadDetails->has_transitioned_to_new_page_experience = isset($data->has_transitioned_to_new_page_experience) ? $data->has_transitioned_to_new_page_experience : null;
                $leadDetails->hours = isset($data->hours) ? json_encode($data->hours) : null;
                $leadDetails->is_always_open = isset($data->is_always_open) ? $data->is_always_open : null;
                $leadDetails->is_community_page = isset($data->is_community_page) ? $data->is_community_page : null;
                $leadDetails->is_messenger_bot_get_started_enabled = isset($data->is_messenger_bot_get_started_enabled) ? $data->is_messenger_bot_get_started_enabled : null;
                $leadDetails->is_messenger_platform_bot = isset($data->is_messenger_platform_bot) ? $data->is_messenger_platform_bot : null;
                $leadDetails->is_owned = isset($data->is_owned) ? $data->is_owned : null;
                $leadDetails->is_permanently_closed = isset($data->is_permanently_closed) ? $data->is_permanently_closed : null;
                $leadDetails->is_published = isset($data->is_published) ? $data->is_published : null;
                $leadDetails->is_unclaimed = isset($data->is_unclaimed) ? $data->is_unclaimed : null;
                $leadDetails->verification_status = isset($data->verification_status) ? $data->verification_status : null;
                $leadDetails->is_webhooks_subscribed = isset($data->is_webhooks_subscribed) ? $data->is_webhooks_subscribed : null;
                $leadDetails->leadgen_tos_accepted = isset($data->leadgen_tos_accepted) ? $data->leadgen_tos_accepted : null;
                $leadDetails->messenger_ads_default_icebreakers = isset($data->messenger_ads_default_icebreakers) ? json_encode($data->messenger_ads_default_icebreakers) : null;
                $leadDetails->overall_star_rating = isset($data->overall_star_rating) ? $data->overall_star_rating : null;
                $leadDetails->place_type = isset($data->place_type) ? $data->place_type : null;
                $leadDetails->price_range = isset($data->price_range) ? $data->price_range : null;
                $leadDetails->rating_count = isset($data->rating_count) ? $data->rating_count : null;
                $leadDetails->talking_about_count = isset($data->talking_about_count) ? $data->talking_about_count : null;
                $leadDetails->temporary_status = isset($data->temporary_status) ? $data->temporary_status : null;
                $leadDetails->username = isset($data->username) ? $data->username : null;
                $leadDetails->were_here_count = isset($data->were_here_count) ? $data->were_here_count : null;
                $leadDetails->save();
            }

            if ($dailySave) {
                $dailySave->count = $dailySave->count + count($pageIds);
                $dailySave->save();
            } else {
                $newSave = new DailySave();
                $newSave->user_id = $userId;
                $newSave->date = $currentDate;
                $newSave->count = $total;
                $newSave->save();
            }

            return $leads;
        }
    }

    public function deleteLead($id)
    {
        Lead::findOrFail($id)->delete();

        Alert::success('Lead deleted', 'Lead has been successfully deleted.');

        return redirect()->back();
    }

    public function massDeleteLead(Request $request)
    {
        $pageIds = $request->secretToken;

        $leads = Lead::whereIn('id', $pageIds)->get();

        foreach ($leads as $lead) {
            $lead->delete();
        }

        return response()->json(true);
    }
}
