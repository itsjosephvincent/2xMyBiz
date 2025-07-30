<?php

namespace App\Http\Controllers\Leads;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Deals;
use App\Models\FacebookUser;
use App\Models\Lead;
use App\Models\LeadGroup;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrganizationController extends Controller
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
        $organizations = Organization::join('lead_groups', 'organizations.lead_group_id', '=', 'lead_groups.id')
            ->join('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->select('organizations.id', 'organizations.organization_name', 'lead_groups.lead_group_name', 'lead_classes.lead_class_name')
            ->whereNull('organizations.user_id')
            ->get();
        $myOrganizations = Organization::join('lead_groups', 'organizations.lead_group_id', '=', 'lead_groups.id')
            ->join('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->select('organizations.id', 'organizations.organization_name', 'lead_groups.lead_group_name', 'lead_classes.lead_class_name')
            ->where('organizations.user_id', $userId)
            ->get();

        $leadgroups = LeadGroup::where('user_id', null)->get();
        $myleadgroups = LeadGroup::where('user_id', $userId)->get();

        return view('lead-pages.organization-list', [
            'currentUser' => $currentUser,
            'organizations' => $organizations,
            'myOrganizations' => $myOrganizations,
            'leadgroups' => $leadgroups,
            'myleadgroups' => $myleadgroups,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $organization = new Organization();
        $organization->lead_group_id = isset($request->lead_group) ? $request->lead_group : null;
        $organization->user_id = $userId;
        $organization->organization_name = $request->organization_name;
        $organization->save();

        Alert::success('Success', 'Lead group created.');

        return redirect()->back();
    }

    public function show(string $id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $organization = Organization::join('lead_groups', 'organizations.lead_group_id', '=', 'lead_groups.id')
            ->join('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->select(
                'organizations.id',
                'organizations.created_at',
                'organizations.organization_name',
                'lead_groups.lead_group_name',
                'lead_classes.lead_class_name',
            )->where('organizations.id', $id)->first();
        $orgs = Organization::whereNull('user_id')->get();
        $myorgs = Organization::where('user_id', $userId)->get();
        $data = FacebookUser::where('user_id', $userId)->first();
        $leadgroups = LeadGroup::where('user_id', null)->get();
        $myleadgroups = LeadGroup::where('user_id', $userId)->get();
        $deals = Deals::whereNull('user_id')->get();
        $mydeals = Deals::where('user_id', $userId)->get();
        $leadscount = Lead::where('organization_id', $organization->id)->where('user_id', $userId)->count();
        $groupleads = Lead::where('organization_id', $organization->id)->where('user_id', $userId)->paginate(10);
        $leads = Lead::whereNull('organization_id')->where('user_id', $userId)->get();

        return view('lead-pages.organization-profile', [
            'currentUser' => $currentUser,
            'organization' => $organization,
            'leadgroups' => $leadgroups,
            'myleadgroups' => $myleadgroups,
            'leadcount' => $leadscount,
            'leads' => $leads,
            'groupleads' => $groupleads,
            'data' => $data,
            'orgs' => $orgs,
            'myorgs' => $myorgs,
            'deals' => $deals,
            'mydeals' => $mydeals,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $organization = Organization::findOrFail($id);
        $organization->organization_name = isset($request->organization_name) ? $request->organization_name : $organization->organization_name;
        $organization->lead_group_id = isset($request->pipeline_category) ? $request->pipeline_category : $organization->lead_group_id;
        $organization->save();

        return redirect()->back();
    }

    public function addLeadToLeadGroup(Request $request, string $id)
    {
        $lead = Lead::findOrFail($request->leads);
        $lead->organization_id = $id;
        $lead->save();

        return redirect()->back();
    }

    public function removeLeadFromGroup(string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->organization_id = null;
        $lead->save();

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $leads = Lead::where('organization_id', $id)->get();
        foreach ($leads as $lead) {
            $lead->organization_id = null;
            $lead->Save();
        }
        Organization::findOrFail($id)->delete();

        Alert::success('Success', 'Lead group deleted.');

        return redirect()->back();
    }

    public function massUpdateOrganization(Request $request)
    {
        $pageIds = $request->pageIds;

        $leads = Lead::whereIn('id', $pageIds)->get();

        foreach ($leads as $lead) {
            $lead->organization_id = $request->leadgroup;
            $lead->save();
        }

        return response()->json(true);
    }

    public function massUpdateStage(Request $request)
    {
        $pageIds = $request->pageIds;

        $leads = Lead::whereIn('id', $pageIds)->get();

        foreach ($leads as $lead) {
            $lead->lead_group_id = $request->stagegroup;
            $lead->save();
        }

        return response()->json(true);
    }

    public function massUpdateDeal(Request $request)
    {
        $pageIds = $request->pageIds;

        $leads = Lead::whereIn('id', $pageIds)->get();

        foreach ($leads as $lead) {
            $lead->deal_id = $request->dealId;
            $lead->save();
        }

        return response()->json(true);
    }
}
