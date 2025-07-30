<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface LinkedinUserRepositoryInterface
{
    public function findByUserId(int $userId);
}
