<?php

namespace App\Repositories;

use App\Contracts\BaseRepositoryInterface;
use App\Enums\SearchParam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findByParam(string $param, mixed $search): ?Model
    {
        try {
            $searchParam = SearchParam::from($param);
            return $this->model->where($searchParam->value, $search)->first();
        } catch (\UnexpectedValueException $e) {
            throw new \UnexpectedValueException($e->getMessage());
        }
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes): Model
    {
        $model = $this->find($id);
        if ($model) {
            $model->update($attributes);
            return $model;
        }
        throw new ModelNotFoundException("The model with id {$id} was not found.");
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        if ($model) {
            return $model->delete();
        }
        throw new ModelNotFoundException("The model with id {$id} was not found.");
    }
}
