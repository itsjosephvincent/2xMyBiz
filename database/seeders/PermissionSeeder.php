<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'name' => 'manage_leads',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //1 manage_leads
            [
                'name' => 'manage_deals',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //2 manage_deals
            [
                'name' => 'manage_users_roles',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //3 manage_users_roles
            [
                'name' => 'manage_notifications',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //4 manage_notifications
            [
                'name' => 'manage_email_templates',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //5 manage_email_templates
            [
                'name' => 'manage_facebook_post',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //6 manage_facebook_post
            [
                'name' => 'manage_post_templates',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //7 manage_post_templates
            [
                'name' => 'create_audit',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //8 create_audit
            [
                'name' => 'create_email',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //9 create_email
            [
                'name' => 'mini_funnel',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //10 mini_funnel
            [
                'name' => 'custom_brand',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ], //11 custom_brand
        ]);
    }
}
