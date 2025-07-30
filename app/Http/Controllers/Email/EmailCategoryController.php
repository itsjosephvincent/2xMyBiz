<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\EmailCategory;
use App\Models\FacebookUser;
use App\Models\User;
use Illuminate\Http\Request;

class EmailCategoryController extends Controller
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
        $categories = EmailCategory::all();

        return view('emails.email-category-list', [
            'currentUser' => $currentUser,
            'categories' => $categories,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $category = new EmailCategory();
        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        EmailCategory::findOrFail($id)->delete();

        return redirect()->back();
    }
}
