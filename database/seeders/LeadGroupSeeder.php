<?php

namespace Database\Seeders;

use App\Models\LeadGroup;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lead_groups = [
            [
                'lead_group_name' => 'COLD LEAD FROM FACEBOOK',
                'class_id' => 1,
            ],
            [
                'lead_group_name' => 'AWARENESS - Email #1',
                'class_id' => 2
            ],
            [
                'lead_group_name' => 'ENGAGE - Connect on LinkedIn',
                'class_id' => 3
            ],
            [
                'lead_group_name' => 'ENGAGE - Facebook Message',
                'class_id' => 4
            ],
            [
                'lead_group_name' => 'ENGAGE - LinkedIn Message',
                'class_id' => 5
            ],
            [
                'lead_group_name' => 'ENGAGE - Instagram Message',
                'class_id' => 6
            ],
            [
                'lead_group_name' => 'ENGAGE - Call',
                'class_id' => 7
            ],
            [
                'lead_group_name' => 'SUBSCRIBE',
                'class_id' => 8
            ],
            [
                'lead_group_name' => 'CONVERT',
                'class_id' => 9
            ],
            [
                'lead_group_name' => 'EXCITE',
                'class_id' => 10
            ],
            [
                'lead_group_name' => 'ASCEND - CLIENT',
                'class_id' => 11
            ],
            [
                'lead_group_name' => 'ASCEND - UPSELL',
                'class_id' => 12
            ],
            [
                'lead_group_name' => 'ADVOCATE',
                'class_id' => 13
            ],
            [
                'lead_group_name' => 'PROMOTE',
                'class_id' => 14
            ],
            [
                'lead_group_name' => 'LOST',
                'class_id' => 15
            ],
        ];

        foreach ($lead_groups as $lead_group) {
            LeadGroup::create([
                'lead_group_name' => $lead_group['lead_group_name'],
                'class_id' => $lead_group['class_id'],
                'created_at' => Carbon::now()
            ]);
        }
    }
}
