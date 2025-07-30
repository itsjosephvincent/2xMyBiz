<?php

namespace App\Http\Controllers\Pipeline;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\Lead;
use App\Models\LeadGroup;
use App\Models\LostReason;
use App\Models\LostReasonCount;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class PipelineViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id',  $userId)->first();

        $orgs = Organization::whereNull('user_id')->get();
        $myorgs = Organization::where('user_id', $userId)->get();

        $leadgroups = LeadGroup::join('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->select('lead_groups.id', 'lead_groups.lead_group_name', 'lead_classes.lead_class_name')
            ->where('user_id', null)
            ->get();
        $myleadgroups = LeadGroup::join('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->select('lead_groups.id', 'lead_groups.lead_group_name', 'lead_classes.lead_class_name')
            ->where('lead_groups.user_id', $userId)
            ->get();
        $leads = Lead::leftJoin('organizations', 'leads.organization_id', '=', 'organizations.id')
            ->leftJoin('deals', 'leads.deal_id', '=', 'deals.id')
            ->select('leads.*', 'organizations.organization_name', 'deals.deal_title', 'deals.deal_price')
            ->where('leads.user_id', $userId)
            ->get();

        $reasons = LostReason::all();

        return view('deal-pages.pipeline-view', [
            'currentUser' => $currentUser,
            'leadgroups' => $leadgroups,
            'myleadgroups' => $myleadgroups,
            'leads' => $leads,
            'reasons' => $reasons,
            'data' => $data,
            'orgs' => $orgs,
            'myorgs' => $myorgs
        ]);
    }

    public function update(Request $request)
    {
        $lost = LeadGroup::where('lead_group_name', 'LOST')->first();

        $lead = Lead::findOrFail($request->leadsecret);
        $lead->lead_group_id = $lost->id;
        $lead->lost_reason_id = $request->reason;
        $lead->save();

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

        return redirect()->back();
    }

    public function filter(Request $request)
    {
        $userId = auth()->user()->id;

        $query = Lead::query()
            ->leftJoin('organizations', 'leads.organization_id', '=', 'organizations.id')
            ->leftJoin('deals', 'leads.deal_id', '=', 'deals.id')
            ->select('leads.*', 'organizations.organization_name', 'deals.deal_title', 'deals.deal_price')
            ->where('leads.user_id', $userId);

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
}
