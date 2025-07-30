<?php

namespace App\Http\Controllers\Leads;

use App\Http\Controllers\Controller;
use App\Models\LeadFile;
use Illuminate\Http\Request;

class LeadFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        $file = $request->file('file_upload');

        $filename = $file->getClientOriginalName();

        $leadfile = new LeadFile();
        $leadfile->lead_id = $request->secret;
        $leadfile->file_name = $filename;
        $leadfile->file_path = '-';
        $leadfile->save();

        $getLeadFile = LeadFile::findOrFail($leadfile->id);
        $getLeadFile->addMediaFromRequest('file_upload')->toMediaCollection('lead_file');
        $getLeadFile->file_path = $getLeadFile->getMedia('lead_file')->last()->getUrl();
        $getLeadFile->save();

        return redirect()->back();
    }
}
