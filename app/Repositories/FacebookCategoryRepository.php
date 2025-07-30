<?php

namespace App\Repositories;

use App\Interfaces\Repositories\FacebookCategoryRepositoryInterface;
use App\Models\FacebookCategory;
use Illuminate\Support\Facades\Log;

class FacebookCategoryRepository implements FacebookCategoryRepositoryInterface
{
    public function findMany()
    {
        $categories = FacebookCategory::all();

        Log::debug($categories);

        return $categories;
    }
}
