<?php

namespace App\Repositories;

use App\Interfaces\Repositories\DashboardCountRepositoryInterface;
use App\Models\DashboardCount;
use App\Models\User;

class DashboardCountRepository implements DashboardCountRepositoryInterface
{
    public function findByUserId(int $userId)
    {
        return DashboardCount::where('user_id', $userId)->first();
    }

    public function incrementDashboardCount(int $userId, int $incremental)
    {
        $dashCount = DashboardCount::where('user_id', $userId)->first();
        $dashCount->search_count = $dashCount->search_count + $incremental;
        $dashCount->save();

        return $dashCount->fresh();
    }

    public function addNewDashCount(int $userId, int $incremental)
    {
        $dashCount = new DashboardCount();
        $dashCount->user_id = $userId;
        $dashCount->search_count = $incremental;
        $dashCount->save();

        return $dashCount->fresh();
    }
}
