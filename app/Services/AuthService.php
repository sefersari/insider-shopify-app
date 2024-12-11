<?php

namespace App\Services;

use App\Models\User;
use Exception;

class AuthService
{
    /**
     * @param array $registerData
     * @return bool
     */
    public function register(array $registerData): bool
    {
        try {
           User::query()
                ->create($registerData);

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
