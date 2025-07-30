<?php

namespace App\Interfaces\Services;

interface AuthServiceInterface
{
    public function loginUser(object $payload);
}
