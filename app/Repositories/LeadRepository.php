<?php

namespace App\Repositories;

use App\Interfaces\Repositories\LeadRepositoryInterface;
use App\Models\Lead;
use App\Models\User;

class LeadRepository implements LeadRepositoryInterface
{
    public function findManyIdByUserId($userId)
    {
        return Lead::where('user_id', $userId)->pluck('lead_id');
    }
}
