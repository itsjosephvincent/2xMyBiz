<?php

namespace App\Http\Controllers\Api\Facebook;

use App\Http\Controllers\Controller;
use App\Http\Requests\FindLeadsRequest;
use App\Interfaces\Services\FacebookLeadsServiceInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FacebookLeadsController extends Controller
{
    private $facebookLeadsService;

    public function __construct(FacebookLeadsServiceInterface $facebookLeadsService)
    {
        $this->facebookLeadsService = $facebookLeadsService;
    }

    public function findLeads(FindLeadsRequest $request)
    {
        $payload = (object) $request->only([
            'category_name',
            'keyword'
        ]);

        return $this->facebookLeadsService->findFacebookLeads($payload);
    }
}
