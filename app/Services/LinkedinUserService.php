<?php

namespace App\Services;

use App\Http\Resources\LinkedinUserResource;
use App\Interfaces\Repositories\LinkedinUserRepositoryInterface;
use App\Interfaces\Services\LinkedinUserServiceInterface;
use App\Models\User;

class LinkedinUserService implements LinkedinUserServiceInterface
{
    private $linkedinUserRepository;

    public function __construct(LinkedinUserRepositoryInterface $linkedinUserRepository)
    {
        $this->linkedinUserRepository = $linkedinUserRepository;
    }

    public function findLinkedinUserByUserId(int $userId)
    {
        $linkedinUser = $this->linkedinUserRepository->findByUserId($userId);

        return new LinkedinUserResource($linkedinUser);
    }
}
