<?php

namespace App\Services;

use App\Http\Resources\FacebookResource;
use App\Interfaces\Repositories\FacebookUserRepositoryInterface;
use App\Interfaces\Services\FacebookUserServiceInterface;
use App\Models\User;

class FacebookUserService implements FacebookUserServiceInterface
{
    private $facebookRepository;

    public function __construct(FacebookUserRepositoryInterface $facebookRepository)
    {
        $this->facebookRepository = $facebookRepository;
    }

    public function findFacebookByUserId(int $userId)
    {
        $facebookUser = $this->facebookRepository->findByUserId($userId);

        return new FacebookResource($facebookUser);
    }
}
