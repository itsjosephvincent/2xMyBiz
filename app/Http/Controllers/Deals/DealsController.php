<?php

namespace App\Http\Controllers\Deals;

use App\Http\Controllers\Controller;
use App\Models\Deals;
use App\Models\FacebookUser;
use App\Models\User;
use Illuminate\Http\Request;

class DealsController extends Controller
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
        $deals = Deals::whereNull('user_id')->get();
        $mydeals = Deals::where('user_id', $userId)->get();

        return view('deal-pages.deals', [
            'currentUser' => $currentUser,
            'deals' => $deals,
            'mydeals' => $mydeals,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $deal = new Deals();
        $deal->user_id = $userId;
        $deal->deal_title = $request->deal_title;
        $deal->deal_price = $request->deal_price;
        $deal->save();

        return redirect()->back();
    }

    public function getDeal(Request $request)
    {
        $deal = Deals::findOrFail($request->deal_id);

        return $deal;
    }

    public function updateDeal(Request $request)
    {
        $deal = Deals::findOrFail($request->dealtokenid);
        $deal->deal_title = isset($request->deal_title) ? $request->deal_title : $deal->deal_title;
        $deal->deal_price = isset($request->deal_price) ? $request->deal_price : $deal->deal_price;
        $deal->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Deals::findOrFail($id)->delete();

        return redirect()->back();
    }
}
