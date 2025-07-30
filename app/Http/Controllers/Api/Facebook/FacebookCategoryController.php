<?php

namespace App\Http\Controllers\Api\Facebook;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\FacebookCategoryServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FacebookCategoryController extends Controller
{
    private $facebookCategoryService;

    public function __construct(FacebookCategoryServiceInterface $facebookCategoryService)
    {
        $this->facebookCategoryService = $facebookCategoryService;
    }

    public function index(): JsonResponse
    {
        return $this->facebookCategoryService->findFacebookCategories()->response();
    }
}
