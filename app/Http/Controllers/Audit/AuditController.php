<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\AuditAnswer;
use App\Models\AuditQuestion;
use App\Models\FacebookUser;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\User;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(string $id)
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
                'leads.email',
                'leads.lead_photo',
                'leads.created_at',
                'lead_groups.lead_group_name',
                'lead_classes.lead_class_name',
                'organizations.organization_name',
                'leadclasses.lead_class_name as leadclassname',
            )
            ->where('leads.id', $id)
            ->first();
        $questions = AuditQuestion::all();

        $leadDetails = LeadDetail::where('lead_id', $id)->first();

        $response1 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 1)
            ->first();
        $response2 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 2)
            ->first();
        $response3 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 3)
            ->first();
        $response4 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 4)
            ->first();
        $response5 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 5)
            ->first();
        $response6 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 6)
            ->first();
        $response7 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 7)
            ->first();
        $response8 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 8)
            ->first();
        $response9 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 9)
            ->first();
        $response10 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 10)
            ->first();
        $response11 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 11)
            ->first();
        $response12 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 12)
            ->first();
        $response13 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 13)
            ->first();
        $response14 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 14)
            ->first();
        $response15 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 15)
            ->first();
        $response16 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 16)
            ->first();
        $response17 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 17)
            ->first();
        $response18 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 18)
            ->first();
        $response19 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 19)
            ->first();
        $response20 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 20)
            ->first();
        $response21 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 21)
            ->first();
        $response22 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 22)
            ->first();
        $response23 = AuditAnswer::where('user_id', $userId)
            ->where('page_id', $id)
            ->where('question_id', 23)
            ->first();

        return view('lead-pages.lead-audit', [
            'currentUser' => $currentUser,
            'lead' => $lead,
            'leadDetails' => $leadDetails,
            'data' => $data,
            'questions' => $questions,
            'response1' => $response1,
            'response2' => $response2,
            'response3' => $response3,
            'response4' => $response4,
            'response5' => $response5,
            'response6' => $response6,
            'response7' => $response7,
            'response8' => $response8,
            'response9' => $response9,
            'response10' => $response10,
            'response11' => $response11,
            'response12' => $response12,
            'response13' => $response13,
            'response14' => $response14,
            'response15' => $response15,
            'response16' => $response16,
            'response17' => $response17,
            'response18' => $response18,
            'response19' => $response19,
            'response20' => $response20,
            'response21' => $response21,
            'response22' => $response22,
            'response23' => $response23,
        ]);
    }

    public function update(Request $request, string $id)
    {
        for ($i = 1; $i <= 23; $i++) {
            $group = 'group' . $i;

            $answer = AuditAnswer::where('question_id', $i)
                ->where('page_id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!$answer) {
                $newAnswer = new AuditAnswer();
                $newAnswer->user_id = auth()->user()->id;
                $newAnswer->page_id = $id;
                $newAnswer->question_id = $i;
                $newAnswer->answer = $request->$group;
                $newAnswer->save();
            } else {
                $answer->answer = $request->$group;
                $answer->save();
            }
        }

        $lead = Lead::findOrFail($id);

        $leadDetails = LeadDetail::where('lead_id', $id)->first();
        $leadDetails->audit_link = 'https://facebookaudit.2xmyleads.com/' . $lead->lead_id;
        $leadDetails->save();

        return redirect()->route('audit-page', $lead->id);
    }
}
