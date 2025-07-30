<?php

namespace Database\Seeders;

use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'lead_group_id' => 1,
            'organization_name' => 'General Leads',
            'created_at' => Carbon::now()
        ]);
    }
}
