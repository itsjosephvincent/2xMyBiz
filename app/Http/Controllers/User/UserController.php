<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exportUser(Request $request)
    {
        $userIds = $request->idBox;
        $data = User::whereIn('id', $userIds)->get();
        $filename = '2xMyLeads - Users.csv';

        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('id', 'first_name', 'last_name', 'email', 'gender', 'birthday', 'status', 'last_login'));
        foreach ($data as $row) {
            fputcsv($handle, array(
                $row->id,
                isset($row->first_name) ? $row->first_name : null,
                isset($row->last_name) ? $row->last_name : null,
                isset($row->email) ? $row->email : null,
                isset($row->gender) ? $row->gender : null,
                isset($row->birthday) ? $row->birthday : null,
                isset($row->status) ? $row->status : null,
                isset($row->last_login) ? $row->last_login : null,
            ));
        }
        fclose($handle);

        // download CSV file
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        if ($request->ajax()) {
            return Response::make(file_get_contents($filename), 200, $headers);
        } else {
            return Response::download($filename, $filename, $headers);
        }
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->status = $request->status;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->role == 'Admin') {
            DB::table('model_has_roles')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_permissions')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Admin');
            $user->givePermissionTo([
                'manage_leads',
                'manage_deals',
                'manage_users_roles',
                'manage_notifications',
                'manage_email_templates',
                'manage_facebook_post',
                'manage_post_templates',
                'create_audit',
                'create_email',
                'mini_funnel',
                'custom_brand'
            ]);
        }
        if ($request->role == 'Free') {
            DB::table('model_has_roles')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_permissions')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Free');
            $user->givePermissionTo([
                'manage_leads',
                'create_email'
            ]);
        }
        if ($request->role == 'Freelancer') {
            DB::table('model_has_roles')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_permissions')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Freelancer');
            $user->givePermissionTo([
                'manage_leads',
                'manage_deals',
                'create_email'
            ]);
        }
        if ($request->role == 'Pro') {
            DB::table('model_has_roles')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_permissions')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Pro');
            $user->givePermissionTo([
                'manage_leads',
                'manage_deals',
                'create_audit',
                'create_email',
                'mini_funnel',
                'custom_brand'
            ]);
        }
        if ($request->role == 'Agency') {
            DB::table('model_has_roles')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();
            DB::table('model_has_permissions')->where('model_type', 'App\Models\User')->where('model_id', $user->id)->delete();

            $user->assignRole('Agency');
            $user->givePermissionTo([
                'manage_leads',
                'manage_deals',
                'manage_facebook_post',
                'create_audit',
                'create_email',
                'mini_funnel',
                'custom_brand'
            ]);
        }

        Alert::success('Success', 'User updated successfully.');

        return redirect()->back();
    }

    public function updateUserDetails(Request $request)
    {
        UserDetails::updateOrCreate(
            [
                'user_id' => $request->id
            ],
            [
                'country_code' => isset($request->country_code) ? $request->country_code : null,
                'contact_number' => isset($request->contact_number) ? $request->contact_number : null,
                'company' => isset($request->company) ? $request->company : null,
                'sales_tax_id' => isset($request->sales_tax_id) ? $request->sales_tax_id : null,
                'ip_address' => isset($request->ip_address) ? $request->ip_address : null,
                'ip_country' => isset($request->ip_country) ? $request->ip_country : null,
                'address1' => isset($request->address1) ? $request->address1 : null,
                'city' => isset($request->city) ? $request->city : null,
                'zip' => isset($request->zip) ? $request->zip : null,
                'country' => isset($request->country) ? $request->country : null,
                'state' => isset($request->state) ? $request->state : null,
                'website' => isset($request->website) ? $request->website : null
            ]
        );

        return redirect()->back()->with('userInfo', 'User information updated');
    }
}
