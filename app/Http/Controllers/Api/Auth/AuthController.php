<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Interfaces\Services\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $payload = (object) $request->only([
            'email',
            'password'
        ]);

        return $this->authService->loginUser($payload)->response();
    }
}
