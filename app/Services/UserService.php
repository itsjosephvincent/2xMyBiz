<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findUsers()
    {
        $userList = $this->userRepository->findMany();

        return UserResource::collection($userList);
    }



    public function findUserById(int $userId)
    {
        $user = $this->userRepository->findOneById($userId);

        return new UserResource($user);
    }

    public function findUserByEmail(string $email)
    {
        $user = $this->userRepository->findOneByEmail($email);

        return new UserResource($user);
    }

    public function createUser(object $payload)
    {
        $user = $this->userRepository->create($payload);

        return new UserResource($user);
    }

    public function updateUser(object $payload, int $userId)
    {
        $user = $this->userRepository->update($payload, $userId);

        return new UserResource($user);
    }

    public function deleteUser(int $userId)
    {
        $user = $this->userRepository->delete($userId);

        return new UserResource($user);
    }
}
