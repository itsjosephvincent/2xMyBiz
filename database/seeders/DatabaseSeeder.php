<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            FacebookCategorySeeder::class,
            LeadClassSeeder::class,
            LeadGroupSeeder::class,
            LostReasonSeeder::class,
            EmailCategorySeeder::class,
            DealSeeder::class,
            AuditQuestionSeeder::class,
            OrganizationSeeder::class,
            UpdateAgencyPermissionSeeder::class,
            UpdateProPermissionSeeder::class,
            UpdateAdminPermissionSeeder::class,
            UpdateFreeUserSeeder::class,
            LinkedInCategorySeeder::class
        ]);
    }
}
