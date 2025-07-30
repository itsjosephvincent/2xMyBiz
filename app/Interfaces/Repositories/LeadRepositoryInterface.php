<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface LeadRepositoryInterface
{
    public function findManyIdByUserId(int $userId);
}
