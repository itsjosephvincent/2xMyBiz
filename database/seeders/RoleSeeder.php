<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Free',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Freelancer',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Pro',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Agency',
                'guard_name' => 'web',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
