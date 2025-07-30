<?php

namespace App\Interfaces\Services;

use App\Models\User;

interface UserServiceInterface
{
    public function findUsers();
    public function findUserById(int $userId);
    public function findUserByEmail(string $email);
    public function createUser(object $payload);
    public function updateUser(object $payload, int $userId);
    public function deleteUser(int $userId);
}
