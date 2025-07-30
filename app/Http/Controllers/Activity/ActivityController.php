<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $activity = new Activity();
        $activity->lead_id = $request->secret;
        $activity->activity_type = $request->activity;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->date_from = $request->set_date_from;
        $activity->time_from = Carbon::parse($request->set_time_from)->format('H:i:s');
        $activity->date_to = $request->set_date_to;
        $activity->time_to = Carbon::parse($request->set_time_to)->format('H:i:s');
        $activity->save();

        return redirect()->back();
    }

    public function updateStatus(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->status = 'Done';
        $activity->save();

        return redirect()->back();
    }
}
