<?php

namespace Database\Seeders;

use App\Models\LostReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LostReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lost_reasons')->insert([
            [
                'user_id' => null,
                'reason' => 'Not a Qualified Lead'
            ],
            [
                'user_id' => null,
                'reason' => 'Cost Was Too High'
            ],
            [
                'user_id' => null,
                'reason' => 'Not the Right Time'
            ],
            [
                'user_id' => null,
                'reason' => 'Not Interested'
            ],
            [
                'user_id' => null,
                'reason' => 'Not Needed'
            ],
            [
                'user_id' => null,
                'reason' => 'They Already Have a “Guy”'
            ],
            [
                'user_id' => null,
                'reason' => 'Took Too Long to Respond'
            ],
            [
                'user_id' => null,
                'reason' => 'No Longer in Business'
            ],
            [
                'user_id' => null,
                'reason' => 'Other'
            ]
        ]);
    }
}
