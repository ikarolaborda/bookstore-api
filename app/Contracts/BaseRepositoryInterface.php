<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Model;
    public function findByParam(string $param, mixed $search): ?Model;
    public function create(array $attributes): Model;
    public function update(int $id, array $attributes): Model;
    public function delete(int $id): bool;
}

