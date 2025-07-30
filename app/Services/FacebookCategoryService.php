<?php

namespace App\Services;

use App\Http\Resources\FacebookCategoryResource;
use App\Interfaces\Repositories\FacebookCategoryRepositoryInterface;
use App\Interfaces\Services\FacebookCategoryServiceInterface;

class FacebookCategoryService implements FacebookCategoryServiceInterface
{
    private $facebookCategoryRepository;

    public function __construct(FacebookCategoryRepositoryInterface $facebookCategoryRepository)
    {
        $this->facebookCategoryRepository = $facebookCategoryRepository;
    }

    public function findFacebookCategories()
    {
        $categories = $this->facebookCategoryRepository->findMany();

        return FacebookCategoryResource::collection($categories);
    }
}
