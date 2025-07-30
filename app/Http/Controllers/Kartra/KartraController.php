<?php

namespace App\Http\Controllers\Kartra;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class KartraController extends Controller
{
    public function agency(Request $request)
    {
        $data = json_decode($request->getContent());

        $user = User::where('email', $data->action_details->transaction_details->buyer_email)->first();

        if ($user) {
            DB::table('model_has_permissions')->where('App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_roles')->where('App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Agency');
            $user->givePermissionTo(['manage_leads', 'manage_deals', 'manage_facebook_post', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        } else {
            $newUser = new User();
            $newUser->first_name = $data->action_details->transaction_details->buyer_first_name;
            $newUser->last_name = $data->action_details->transaction_details->buyer_last_name;
            $newUser->email = $data->action_details->transaction_details->buyer_email;
            $newUser->password = Hash::make('2xMyB!zM@rketing');
            $newUser->save();

            $newUser->assignRole('Agency');
            $newUser->givePermissionTo(['manage_leads', 'manage_deals', 'manage_facebook_post', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        }

        return true;
    }

    public function pro(Request $request)
    {
        $data = json_decode($request->getContent());

        $user = User::where('email', $data->action_details->transaction_details->buyer_email)->first();

        if ($user) {
            DB::table('model_has_permissions')->where('App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_roles')->where('App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Pro');
            $user->givePermissionTo(['manage_leads', 'manage_deals', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        } else {
            $newUser = new User();
            $newUser->first_name = $data->action_details->transaction_details->buyer_first_name;
            $newUser->last_name = $data->action_details->transaction_details->buyer_last_name;
            $newUser->email = $data->action_details->transaction_details->buyer_email;
            $newUser->password = Hash::make('2xMyB!zM@rketing');
            $newUser->save();

            $newUser->assignRole('Pro');
            $newUser->givePermissionTo(['manage_leads', 'manage_deals', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        }

        return true;
    }

    public function proForm(Request $request)
    {
        $data = json_decode($request->getContent());

        $user = User::where('email', $data->lead->email)->first();

        if ($user) {
            DB::table('model_has_permissions')->where('App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_roles')->where('App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Pro');
            $user->givePermissionTo(['manage_leads', 'manage_deals', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        } else {
            $newUser = new User();
            $newUser->first_name = $data->lead->first_name;
            $newUser->last_name = $data->lead->last_name;
            $newUser->email = $data->lead->email;
            $newUser->password = Hash::make('2xMyB!zM@rketing');
            $newUser->save();

            $newUser->assignRole('Pro');
            $newUser->givePermissionTo(['manage_leads', 'manage_deals', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        }

        return true;
    }

    public function freelancer(Request $request)
    {
        $data = json_decode($request->getContent());

        $user = User::where('email', $data->action_details->transaction_details->buyer_email)->first();

        if ($user) {
            DB::table('model_has_permissions')->where('App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_roles')->where('App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Freelancer');
            $user->givePermissionTo(['manage_leads', 'manage_deals']);
        } else {
            $newUser = new User();
            $newUser->first_name = $data->action_details->transaction_details->buyer_first_name;
            $newUser->last_name = $data->action_details->transaction_details->buyer_last_name;
            $newUser->email = $data->action_details->transaction_details->buyer_email;
            $newUser->password = Hash::make('2xMyB!zM@rketing');
            $newUser->save();

            $newUser->assignRole('Freelancer');
            $newUser->givePermissionTo(['manage_leads', 'manage_deals', 'create_email']);
        }

        return true;
    }

    public function free(Request $request)
    {
        $data = json_decode($request->getContent());

        $user = User::where('email', $data->lead->email)->first();

        if ($user) {
            DB::table('model_has_permissions')->where('App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_roles')->where('App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Free');
            $user->givePermissionTo(['manage_leads', 'create_email']);
        } else {
            $newUser = new User();
            $newUser->first_name = $data->lead->first_name;
            $newUser->last_name = $data->lead->last_name;
            $newUser->email = $data->lead->email;
            $newUser->password = Hash::make('2xMyB!zM@rketing');
            $newUser->save();

            $newUser->assignRole('Free');
            $newUser->givePermissionTo(['manage_leads']);
        }

        return true;
    }

    public function cancel(Request $request)
    {
        $data = json_decode($request->getContent());

        $user = User::where('email', $data->lead->email)->first();
        $user->status = 'inactive';
        $user->save();
    }

    public function updateFreeUserPermissions()
    {
        $role = Role::where('name', 'Free')->first();
        $users = DB::table('model_has_roles')->where('role_id', $role->id)->get();

        foreach ($users as $user) {
            DB::table('model_has_permissions')->where('model_id', $user->model_id)->delete();
            DB::table('model_has_roles')->where('model_id', $user->model_id)->delete();

            $freeUser = User::findOrFail($user->model_id);
            $freeUser->assignRole('Free');
            $freeUser->givePermissionTo(['manage_leads', 'create_email']);
        }

        return response()->json(['Update Complete']);
    }

    public function updateFreelanceUserPermissions()
    {
        $role = Role::where('name', 'Freelancer')->first();
        $users = DB::table('model_has_roles')->where('role_id', $role->id)->get();

        foreach ($users as $user) {
            DB::table('model_has_permissions')->where('model_id', $user->model_id)->delete();
            DB::table('model_has_roles')->where('model_id', $user->model_id)->delete();

            $freeUser = User::findOrFail($user->model_id);
            $freeUser->assignRole('Freelancer');
            $freeUser->givePermissionTo(['manage_leads', 'manage_deals', 'create_email']);
        }

        return response()->json(['Update Complete']);
    }
}
