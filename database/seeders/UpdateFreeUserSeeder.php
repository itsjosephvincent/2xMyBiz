<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UpdateFreeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'Free')->first();
        $users = DB::table('model_has_roles')->where('role_id', $role->id)->get();

        foreach ($users as $user) {
            DB::table('model_has_permissions')->where('model_id', $user->model_id)->delete();
            DB::table('model_has_roles')->where('model_id', $user->model_id)->delete();

            $agencyUser = User::findOrFail($user->model_id);
            $agencyUser->assignRole('Free');
            $agencyUser->givePermissionTo(['manage_leads', 'manage_deals', 'manage_facebook_post', 'create_audit', 'create_email', 'mini_funnel', 'custom_brand']);
        }
    }
}
