<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

interface BaseServiceInterface
{
    public function getAll(): AnonymousResourceCollection | Collection | array;

    public function getById(int $id): Model | array;

    public function update(int $id, array $attributes): Model | array;

    public function delete(int $id): bool;

}
