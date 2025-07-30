<?php

namespace App\Http\Controllers\UserRoles;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $allmembers = User::paginate(10);
        $activemembers = User::where('status', 'active')->paginate(10);
        $roles = Role::orderBy('created_at', 'asc')->get();
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();

        foreach ($activemembers as $member) {
            if ($member->isLastLoginOlderThanSixMonths()) {
                $updateUser = User::findOrFail($member->id);
                $updateUser->status = 'inactive';
                $updateUser->save();
            }
        }

        $inactivemembers = User::where('status', 'inactive')->paginate(10);

        return view('pages.users-roles', [
            'allmembers' => $allmembers,
            'activemembers' => $activemembers,
            'inactivemembers' => $inactivemembers,
            'roles' => $roles,
            'currentUser' => $currentUser,
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        if ($request->roles) {
            $role = Role::where('name', $request->roles)->first();
            $permissions = Permission::where('role_id', $role->id)->get();
            $permissionArray = [];
            foreach ($permissions as $permission) {
                array_push($permissionArray, $permission->name);
            }
            $user = User::findOrFail($request->user_id);
            DB::table('model_has_roles')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_permissions')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $user->assignRole($role);
            $user->givePermissionTo($permissionArray);

            return redirect()->back();
        } else {
            $user = User::findOrFail($request->user_id);
            $user->first_name = isset($request->first_name) ? $request->first_name : $user->first_name;
            $user->last_name = isset($request->last_name) ? $request->last_name : $user->last_name;
            $user->email = isset($request->email) ? $request->email : $user->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return redirect()->back();
        }
    }

    public function searchFilter(Request $request)
    {
        $searchTerm = $request->search_user;

        $users = User::with('roles')->where(function ($query) use ($searchTerm) {
            $query->orWhere('users.email', 'like', '%' . $searchTerm . '%');
            $query->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
            $query->orWhere('users.last_name', 'like', '%' . $searchTerm . '%');
        })->get();

        return $users;
    }

    public function searchActiveFilter(Request $request)
    {
        $searchTerm = $request->search_user;

        $users = User::with('roles')
            ->where('status', 'active')
            ->where(function ($query) use ($searchTerm) {
                $query->orWhere('users.email', 'like', '%' . $searchTerm . '%');
                $query->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
                $query->orWhere('users.last_name', 'like', '%' . $searchTerm . '%');
            })->get();

        return $users;
    }

    public function searchInactiveFilter(Request $request)
    {
        $searchTerm = $request->search_user;

        $users = User::with('roles')
            ->where('status', 'inactive')
            ->where(function ($query) use ($searchTerm) {
                $query->orWhere('users.email', 'like', '%' . $searchTerm . '%');
                $query->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
                $query->orWhere('users.last_name', 'like', '%' . $searchTerm . '%');
            })->paginate(10);

        return $users;
    }

    public function showUser(string $id)
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $data = FacebookUser::where('user_id', $userId)->first();
        $user = User::findOrFail($id);
        $info = UserDetails::where('user_id', $id)->first();

        return view('user-pages.user-profile', [
            'currentUser' => $currentUser,
            'user' => $user,
            'info' => $info,
            'data' => $data
        ]);
    }

    public function createUser(Request $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->role == 'Free') {
            $user->assignRole('Free');
            $user->givePermissionTo(['manage_leads', 'create_email']);
        } else if ($request->role == 'Freelancer') {
            $user->assignRole('Freelancer');
            $user->givePermissionTo(['manage_leads', 'manage_deals', 'create_email']);
        } else if ($request->role == 'Pro') {
            $user->assignRole('Pro');
            $user->givePermissionTo(['manage_leads', 'manage_deals', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        } else if ($request->role == 'Agency') {
            $user->assignRole('Agency');
            $user->givePermissionTo(['manage_leads', 'manage_deals', 'manage_facebook_post', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        } else {
            $user->assignRole('Admin');
            $user->givePermissionTo(['manage_leads', 'manage_deals', 'manage_users_roles', 'manage_notifications', 'manage_email_templates', 'manage_facebook_post', 'manage_post_templates', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        }

        return true;
    }

    public function loginAsUser($id)
    {
        $user = User::findOrFail($id);

        Auth::logout();

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
