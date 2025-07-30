<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface DailySearchRepositoryInterface
{
    public function findByUserIdAndCurrentDate(int $userId, string $date);
    public function incrementSearch(int $userId, int $incremental);
    public function addNewSearchCount(int $userId, string $date, int $incremental);
}
