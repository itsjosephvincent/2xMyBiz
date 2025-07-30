<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lead_classes')->insert([
            [
                'lead_class_name' => 'Blue-Magenta',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Deep-Blue',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Deep-Purple',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Dark-Violet',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Deep-Violet',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Dark-Lavender',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Bright-Purple',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Hot-Pink',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Bright-Pink',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Bright-Red',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Bright-Orange',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Vivid-Orange',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Lemon-Yellow',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Pastel-Yellow',
                'created_at' => Carbon::now()
            ],
            [
                'lead_class_name' => 'Midnight-Blue',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
