<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findMany();
    public function findOneById(int $userId);
    public function findOneByEmail(string $email);
    public function create(object $payload);
    public function update(object $payload, int $userId);
    public function delete(int $userId);
}
