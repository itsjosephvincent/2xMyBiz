<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UpdateAdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'Admin')->first();
        $users = DB::table('model_has_roles')->where('role_id', $role->id)->get();

        foreach ($users as $user) {
            DB::table('model_has_permissions')->where('model_id', $user->model_id)->delete();
            DB::table('model_has_roles')->where('model_id', $user->model_id)->delete();

            $agencyUser = User::findOrFail($user->model_id);
            $agencyUser->assignRole('Admin');
            $agencyUser->givePermissionTo(['manage_leads', 'manage_deals', 'manage_users_roles', 'manage_notifications', 'manage_email_templates', 'manage_facebook_post', 'manage_post_templates', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        }
    }
}
