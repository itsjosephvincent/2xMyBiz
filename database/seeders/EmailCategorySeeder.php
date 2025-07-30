<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('email_categories')->insert([
            [
                'category_name' => 'Digital Marketing',
                'created_at' => Carbon::now()
            ],
            [
                'category_name' => 'Social Media Marketing',
                'created_at' => Carbon::now()
            ],
            [
                'category_name' => 'Facebook Ads',
                'created_at' => Carbon::now()
            ],
            [
                'category_name' => 'Local Marketing',
                'created_at' => Carbon::now()
            ],
            [
                'category_name' => 'Video Marketing',
                'created_at' => Carbon::now()
            ],
            [
                'category_name' => 'Copywriting',
                'created_at' => Carbon::now()
            ],
            [
                'category_name' => 'Google Ads',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
