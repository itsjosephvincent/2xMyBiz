<?php

namespace App\Repositories;

use App\Interfaces\Repositories\DailySearchRepositoryInterface;
use App\Models\DailySearch;
use App\Models\User;

class DailySearchRepository implements DailySearchRepositoryInterface
{
    public function findByUserIdAndCurrentDate(int $userId, string $date)
    {
        return DailySearch::where('user_id', $userId)
            ->where('date', $date)
            ->first();
    }

    public function incrementSearch(int $userId, int $incremental)
    {
        $searchCount = DailySearch::where('user_id', $userId)->first();
        $searchCount->count = $searchCount->count + $incremental;
        $searchCount->save();

        return $searchCount->fresh();
    }

    public function addNewSearchCount(int $userId, string $date, int $incremental)
    {
        $searchCount = new DailySearch();
        $searchCount->user_id = $userId;
        $searchCount->date = $date;
        $searchCount->count = $incremental;
        $searchCount->save();

        return $searchCount->fresh();
    }
}
