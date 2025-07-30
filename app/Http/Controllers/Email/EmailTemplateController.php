<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\EmailCategory;
use App\Models\EmailTemplate;
use App\Models\FacebookUser;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\User;
use App\Models\UserBusiness;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $templates = EmailTemplate::all();
        $categories = EmailCategory::all();
        $data = FacebookUser::where('user_id', $userId)->first();

        return view('emails.email-templates', [
            'currentUser' => $currentUser,
            'templates' => $templates,
            'categories' => $categories,
            'data' => $data
        ]);
    }

    public function create()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $categories = EmailCategory::all();
        $data = FacebookUser::where('user_id', $userId)->first();

        return view('emails.create-email', [
            'currentUser' => $currentUser,
            'categories' => $categories,
            'data' => $data
        ]);
    }

    public function getEmailByCategory(Request $request)
    {
        $emailcategorylist = EmailTemplate::where('category_id', $request->category_id)->get();
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
                'leads.email',
                'leads.created_at',
                'lead_groups.lead_group_name',
                'lead_classes.lead_class_name',
                'organizations.organization_name',
                'leadclasses.lead_class_name as leadclassname',
            )
            ->where('leads.id', $request->lead_id)
            ->first();

        $emailcategories = EmailCategory::all();
        $category = EmailCategory::findOrFail($request->category_id);

        return view('lead-pages.lead-email', [
            'currentUser' => $currentUser,
            'lead' => $lead,
            'emailcategories' => $emailcategories,
            'emailcategorylist' => $emailcategorylist,
            'category' => $category->category_name,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $email = new EmailTemplate();
        $email->category_id = $request->category;
        $email->title = $request->title;
        $email->message = $request->message;
        $email->save();

        return redirect()->route('email-templates');
    }

    public function findEmail(Request $request)
    {
        $email = EmailTemplate::findOrFail($request->email_id);

        return $email;
    }

    public function editEmail(string $id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $email = EmailTemplate::join('email_categories', 'email_templates.category_id', '=', 'email_categories.id')
            ->select(
                'email_templates.id as templateid',
                'email_templates.title',
                'email_templates.message',
                'email_categories.category_name'
            )->where('email_templates.id', $id)
            ->first();

        return view('emails.email', [
            'currentUser' => $currentUser,
            'email' => $email,
            'data' => $data,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $email = EmailTemplate::findOrFail($id);
        $email->message = $request->message;
        $email->save();

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        EmailTemplate::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function convertShortCodes(Request $request)
    {
        $leads = Lead::findOrFail($request->editsecrettoken);
        $leadDetails = LeadDetail::where('lead_id', $leads->id)->first();
        $user = UserBusiness::where('user_id', $request->secrettoken)->first();
        $userInfo = User::findOrFail($request->secrettoken);
        $message = $request->editemail;

        if ($user) {
            $placeholders = [
                '[Business Name]' => $leads->lead_name,
                '[Business name]' => $leads->lead_name,
                '[Email]' => $leads->email,
                '[Address]' => $leads->street . ', ' . $leads->city . ', ' . $leads->zip,
                '[Link]' => $leads->link,
                '[Website]' => $leads->website,
                '[About]' => $leadDetails->about,
                '[Category]' => $leadDetails->category,
                '[Fan count]' => $leadDetails->fan_count,
                '[Followers count]' => $leadDetails->followers_count,
                '[Star rating]' => $leadDetails->overall_star_rating,
                '[Rating count]' => $leadDetails->rating_count,
                '[Talking about]' => $leadDetails->talking_about_count,
                '[Username]' => $leadDetails->username,
                '[Where here]' => $leadDetails->were_here_count,
                '[Audit link]' => $leadDetails->audit_link,
                '[Your Name]' => $userInfo->first_name . ' ' . $userInfo->last_name,
                '[My Business name]' => $user->business_name,
                '[My Email]' => $user->business_email,
                '[My Address]' => $user->business_address,
                '[My Website]' => $user->business_website,
                '[My Phone]' => $user->business_phone,
                '[My Calendar Link]' => $user->business_calendar_link,
                '[My 2xMyLeads Link]' => $user->myleads_link,
                '[My Kartra Link]' => $user->kartra_link,
                '[About my company]' => $user->about_us
            ];
        } else {
            $placeholders = [
                '[Business name]' => $leads->lead_name,
                '[Business Name]' => $leads->lead_name,
                '[Email]' => $leads->email,
                '[Address]' => $leads->street . ', ' . $leads->city . ', ' . $leads->zip,
                '[Link]' => $leads->link,
                '[Website]' => $leads->website,
                '[About]' => $leadDetails->about,
                '[Category]' => $leadDetails->category,
                '[Fan count]' => $leadDetails->fan_count,
                '[Followers count]' => $leadDetails->followers_count,
                '[Star rating]' => $leadDetails->overall_star_rating,
                '[Rating count]' => $leadDetails->rating_count,
                '[Talking about]' => $leadDetails->talking_about_count,
                '[Username]' => $leadDetails->username,
                '[Where here]' => $leadDetails->were_here_count,
                '[Audit link]' => $leadDetails->audit_link,
                '[Your Name]' => $userInfo->first_name . ' ' . $userInfo->last_name,
            ];
        }

        $newMessage = str_replace(array_keys($placeholders), array_values($placeholders), $message);

        return response()->json(['message' => $newMessage]);
    }
}
