<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface FacebookUserRepositoryInterface
{
    public function findByUserId(int $userId);
}
