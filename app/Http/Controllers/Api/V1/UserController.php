<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        // Implement the method
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        // Implement the method
    }

    public function show(int $id): JsonResponse
    {
        // Implement the method
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        // Implement the method
    }

    public function destroy(int $id): JsonResponse
    {
        // Implement the method
    }
}
