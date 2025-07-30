<?php

namespace App\Providers;

use App\Interfaces\Repositories\BlockLeadRepositoryInterface;
use App\Interfaces\Repositories\DailySearchRepositoryInterface;
use App\Interfaces\Repositories\DashboardCountRepositoryInterface;
use App\Interfaces\Repositories\FacebookCategoryRepositoryInterface;
use App\Interfaces\Repositories\FacebookUserRepositoryInterface;
use App\Interfaces\Repositories\LeadRepositoryInterface;
use App\Interfaces\Repositories\LinkedinUserRepositoryInterface;
use App\Interfaces\Repositories\UserBusinessRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\FacebookCategoryServiceInterface;
use App\Services\FacebookLeadsService;
use App\Interfaces\Services\FacebookLeadsServiceInterface;
use App\Interfaces\Services\LinkedinUserServiceInterface;
use App\Interfaces\Services\UserBusinessServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Repositories\BlockLeadRepository;
use App\Repositories\DailySearchRepository;
use App\Repositories\DashboardCountRepository;
use App\Repositories\FacebookCategoryRepository;
use App\Repositories\FacebookUserRepository;
use App\Repositories\LeadRepository;
use App\Repositories\LinkedinUserRepository;
use App\Repositories\UserBusinessRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\FacebookCategoryService;
use App\Services\FacebookUserService;
use App\Services\LinkedinUserService;
use App\Services\UserBusinessService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(FacebookUserRepositoryInterface::class, FacebookUserRepository::class);
        $this->app->bind(LinkedinUserRepositoryInterface::class, LinkedinUserRepository::class);
        $this->app->bind(FacebookCategoryRepositoryInterface::class, FacebookCategoryRepository::class);
        $this->app->bind(DailySearchRepositoryInterface::class, DailySearchRepository::class);
        $this->app->bind(UserBusinessRepositoryInterface::class, UserBusinessRepository::class);
        $this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
        $this->app->bind(BlockLeadRepositoryInterface::class, BlockLeadRepository::class);
        $this->app->bind(DashboardCountRepositoryInterface::class, DashboardCountRepository::class);
        $this->app->bind(DailySearchRepositoryInterface::class, DailySearchRepository::class);

        //Services
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(FacebookUserRepositoryInterface::class, FacebookUserService::class);
        $this->app->bind(LinkedinUserServiceInterface::class, LinkedinUserService::class);
        $this->app->bind(FacebookCategoryServiceInterface::class, FacebookCategoryService::class);
        $this->app->bind(FacebookLeadsServiceInterface::class, FacebookLeadsService::class);
        $this->app->bind(UserBusinessServiceInterface::class, UserBusinessService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
