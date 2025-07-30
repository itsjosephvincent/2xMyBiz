<?php

namespace App\Http\Controllers\Leads;

use App\Http\Controllers\Controller;
use App\Models\LeadNote;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LeadNotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $leadnote = new LeadNote();
        $leadnote->lead_id = $request->secret;
        $leadnote->title = $request->note_title;
        $leadnote->message = $request->note_message;
        $leadnote->save();

        return redirect()->back();
    }

    public function show($id)
    {
        $leadnote = LeadNote::findOrFail($id);

        return $leadnote;
    }

    public function update(Request $request)
    {
        $note = LeadNote::findOrFail($request->lead_id);
        $note->title = $request->note_title;
        $note->message = $request->note_message;
        $note->save();

        Alert::success('Success', 'Note successfully updated.');

        return redirect()->back();
    }
}
