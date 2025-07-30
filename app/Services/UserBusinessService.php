<?php

namespace App\Services;

use App\Http\Resources\UserBusinessResource;
use App\Interfaces\Repositories\UserBusinessRepositoryInterface;
use App\Interfaces\Services\UserBusinessServiceInterface;
use App\Models\User;

class UserBusinessService implements UserBusinessServiceInterface
{
    private $userBusinessRepository;

    public function __construct(UserBusinessRepositoryInterface $userBusinessRepository)
    {
        $this->userBusinessRepository = $userBusinessRepository;
    }

    public function findUserBusinessByUserId(int $userId)
    {
        $userBusiness = $this->userBusinessRepository->findByUserId($userId);

        return new UserBusinessResource($userBusiness);
    }
}
