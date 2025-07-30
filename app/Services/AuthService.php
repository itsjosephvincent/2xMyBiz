<?php

namespace App\Services;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Http\Resources\UserAuthResource;
use App\Http\Resources\UserResource;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginUser(object $payload)
    {
        $user = $this->userRepository->findOneByEmail($payload->email);

        if (!$user) {
            throw new InvalidCredentialsException();
        } else {
            if (!Hash::check($payload->password, $user->password)) {
                throw new InvalidCredentialsException();
            }

            $token = $user->createToken('auth-token')->plainTextToken;

            $data = (object) [
                'role' => $user->getRoleNames()[0],
                'token' => $token,
                'user' => new UserResource($user)
            ];

            return new UserAuthResource($data);
        }
    }
}
