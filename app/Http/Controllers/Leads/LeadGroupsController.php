<?php

namespace App\Http\Controllers\Leads;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\LeadClass;
use App\Models\LeadGroup;
use App\Models\User;
use Illuminate\Http\Request;

class LeadGroupsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userid = auth()->user()->id;
        $currentUser = User::findOrFail($userid);
        $leadclasses = LeadClass::all();
        $data = FacebookUser::where('user_id', $userid)->first();

        $leadgroups = LeadGroup::where('user_id', null)
            ->join('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->select('lead_groups.id', 'lead_groups.lead_group_name', 'lead_classes.lead_class_name')
            ->get();

        $myleadgroups = LeadGroup::where('user_id', $userid)
            ->join('lead_classes', 'lead_groups.class_id', '=', 'lead_classes.id')
            ->select('lead_groups.id', 'lead_groups.lead_group_name', 'lead_classes.lead_class_name')
            ->get();

        return view('lead-pages.lead-groups', [
            'currentUser' => $currentUser,
            'leadGroups' => $leadgroups,
            'myleadgroups' => $myleadgroups,
            'leadClasses' => $leadclasses,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $leadGroups = new LeadGroup();
        $leadGroups->user_id = $userId;
        $leadGroups->lead_group_name = $request->lead_group_name;
        $leadGroups->class_id = $request->lead_group_class;
        $leadGroups->save();

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        LeadGroup::findOrFail($id)->delete();

        return redirect()->back();
    }
}
