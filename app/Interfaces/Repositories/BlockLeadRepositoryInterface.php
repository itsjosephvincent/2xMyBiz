<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface BlockLeadRepositoryInterface
{
    public function findManyIdByUserId(int $userId);
}
