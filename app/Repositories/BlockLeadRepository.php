<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BlockLeadRepositoryInterface;
use App\Models\BlockedLead;
use App\Models\User;

class BlockLeadRepository implements BlockLeadRepositoryInterface
{
    public function findManyIdByUserId($userId)
    {
        return BlockedLead::where('user_id', $userId)->pluck('page_id');
    }
}
