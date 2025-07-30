<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return $this->userService->findUsers()->response();
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user): JsonResponse
    {
        return $this->userService->findUserById($user)->response();
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $payload = (object) $request->only([
            'first_name',
            'last_name',
            'email',
            'gender',
            'birthday',
        ]);

        return $this->userService->updateUser($payload, $user)->response();
    }

    public function destroy(User $user): JsonResponse
    {
        return $this->userService->deleteUser($user)->response();
    }
}
