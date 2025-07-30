<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface UserBusinessRepositoryInterface
{
    public function findByUserId(int $userId);
}
