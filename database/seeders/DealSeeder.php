<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('deals')->insert([
            [
                'user_id' => null,
                'deal_title' => '1 Year Value',
                'deal_price' => 0.00
            ]
        ]);
    }
}
