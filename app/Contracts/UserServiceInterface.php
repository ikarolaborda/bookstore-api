<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

interface UserServiceInterface extends BaseServiceInterface
{
    public function register(array $attributes): array;

    public function login(array $credentials): ?string;

    public function logout(): bool;

    public function refresh(): ?string;

}
