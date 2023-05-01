<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {
    }

    public function register(array $attributes): array
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return $this->userRepository->create($attributes);
    }
}
