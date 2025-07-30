<?php

namespace App\Services;

use App\Facebook\FacebookAccessToken;
use App\Http\Resources\FacebookLeadsResource;
use App\Interfaces\Repositories\BlockLeadRepositoryInterface;
use App\Interfaces\Repositories\DailySearchRepositoryInterface;
use App\Interfaces\Repositories\DashboardCountRepositoryInterface;
use App\Interfaces\Repositories\LeadRepositoryInterface;
use App\Interfaces\Services\FacebookLeadsServiceInterface;
use App\Modules\Facebook;
use Carbon\Carbon;

class FacebookLeadsService implements FacebookLeadsServiceInterface
{
    private $dailySearchRepository;
    private $getFacebookLeads;
    private $leadRepository;
    private $accessToken;
    private $blockLeadRepository;
    private $dashboardCountRepository;

    public function __construct(
        DailySearchRepositoryInterface $dailySearchRepository,
        LeadRepositoryInterface $leadRepository,
        BlockLeadRepositoryInterface $blockLeadRepository,
        DashboardCountRepositoryInterface $dashboardCountRepository
    ) {
        $this->dailySearchRepository = $dailySearchRepository;
        $this->leadRepository = $leadRepository;
        $this->blockLeadRepository = $blockLeadRepository;
        $this->dashboardCountRepository = $dashboardCountRepository;
        $this->accessToken = new FacebookAccessToken();
        $this->getFacebookLeads = new Facebook();
    }

    public function findFacebookLeads(object $payload)
    {
        $user = auth()->user();
        $role = $user->getRoleNames()[0];
        $currentDate = Carbon::now()->format('Y-m-d');
        $searchCount = $this->dailySearchRepository->findByUserIdAndCurrentDate($user->id, $currentDate);
        $token = $this->accessToken->getFacebookAccessToken();
        $leads = $this->leadRepository->findManyIdByUserId($user->id);
        $blocked = $this->blockLeadRepository->findManyIdByUserId($user->id);
        $dashCount = $this->dashboardCountRepository->findByUserId($user->id);

        if ($role == 'Free') {
            if (!$searchCount || $searchCount->count < 20) {
                $data = $this->getFacebookLeads->searchLeads($payload->category_name, isset($payload->keyword) ?? $payload->keyword, $token);

                $filteredData = $data->filter(function ($page) use ($leads) {
                    return !$leads->contains($page->id);
                });

                $cleanData = $filteredData->filter(function ($lead) use ($blocked) {
                    return !$blocked->contains($lead->id);
                });

                $page = request()->get('page', 1);
                $perPage = 20;
                $offset = ($page - 1) * $perPage;
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $cleanData->slice($offset, $perPage),
                    $cleanData->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );

                if ($dashCount) {
                    $this->dashboardCountRepository->incrementDashboardCount($user->id, 20);
                } else {
                    $this->dashboardCountRepository->addNewDashCount($user->id, 20);
                }

                if ($searchCount) {
                    $this->dailySearchRepository->incrementSearch($user->id, 20);
                } else {
                    $this->dailySearchRepository->addNewSearchCount($user->id, $currentDate, 20);
                }

                return $paginator;
            }
        } else if ($role == 'Freelancer') {
            if (!$searchCount || $searchCount->count < 500) {
                $data = $this->getFacebookLeads->searchLeads($payload->category_name, isset($payload->keyword) ?? $payload->keyword, $token);

                $filteredData = $data->filter(function ($page) use ($leads) {
                    return !$leads->contains($page->id);
                });

                $cleanData = $filteredData->filter(function ($lead) use ($blocked) {
                    return !$blocked->contains($lead->id);
                });

                $page = request()->get('page', 1);
                $perPage = 20;
                $offset = ($page - 1) * $perPage;
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $cleanData->slice($offset, $perPage),
                    $cleanData->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );

                if ($dashCount) {
                    $this->dashboardCountRepository->incrementDashboardCount($user->id, 20);
                } else {
                    $this->dashboardCountRepository->addNewDashCount($user->id, 20);
                }

                if ($searchCount) {
                    $this->dailySearchRepository->incrementSearch($user->id, 20);
                } else {
                    $this->dailySearchRepository->addNewSearchCount($user->id, $currentDate, 20);
                }

                return $paginator;
            }
        } else if ($role == 'Pro') {
            if (!$searchCount || $searchCount->count < 1000) {
                $data = $this->getFacebookLeads->searchLeads($payload->category_name, isset($payload->keyword) ?? $payload->keyword, $token);

                $filteredData = $data->filter(function ($page) use ($leads) {
                    return !$leads->contains($page->id);
                });

                $cleanData = $filteredData->filter(function ($lead) use ($blocked) {
                    return !$blocked->contains($lead->id);
                });

                $page = request()->get('page', 1);
                $perPage = 20;
                $offset = ($page - 1) * $perPage;
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $cleanData->slice($offset, $perPage),
                    $cleanData->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );

                if ($dashCount) {
                    $this->dashboardCountRepository->incrementDashboardCount($user->id, 20);
                } else {
                    $this->dashboardCountRepository->addNewDashCount($user->id, 20);
                }

                if ($searchCount) {
                    $this->dailySearchRepository->incrementSearch($user->id, 20);
                } else {
                    $this->dailySearchRepository->addNewSearchCount($user->id, $currentDate, 20);
                }

                return $paginator;
            }
        } else {
            $data = $this->getFacebookLeads->searchLeads($payload->category_name, isset($payload->keyword) ?? $payload->keyword, $token);

            $filteredData = $data->filter(function ($page) use ($leads) {
                return !$leads->contains($page->id);
            });

            $cleanData = $filteredData->filter(function ($lead) use ($blocked) {
                return !$blocked->contains($lead->id);
            });

            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $cleanData->slice($offset, $perPage),
                $cleanData->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            if ($dashCount) {
                $this->dashboardCountRepository->incrementDashboardCount($user->id, 20);
            } else {
                $this->dashboardCountRepository->addNewDashCount($user->id, 20);
            }

            if ($searchCount) {
                $this->dailySearchRepository->incrementSearch($user->id, 20);
            } else {
                $this->dailySearchRepository->addNewSearchCount($user->id, $currentDate, 20);
            }

            return $paginator;
        }
    }
}
