<?php

namespace App\Services;

use App\Contracts\BaseRepositoryInterface;
use App\Contracts\BaseServiceInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

abstract class BaseService implements BaseServiceInterface
{

    public function __construct(
        protected BaseRepositoryInterface $repository
    )
    {
    }

    public function create(array $attributes): Model | array
    {
        return $this->repository->create($attributes);
    }

    public function getAll(): AnonymousResourceCollection | Collection | array
    {
        return $this->repository->all();
    }

    public function getById(int $id): Model | array
    {
        return $this->repository->find($id);
    }

    public function update(int $id, array $attributes): Model | array
    {
        return $this->repository->update($id, $attributes);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

}
