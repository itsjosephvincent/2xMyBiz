<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface DashboardCountRepositoryInterface
{
    public function findByUserId(int $userId);
    public function incrementDashboardCount(int $userId, int $incremental);
    public function addNewDashCount(int $userId, int $incremental);
}
