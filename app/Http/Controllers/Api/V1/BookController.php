<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        // Implement the method
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        // Implement the method
    }

    public function show(int $id): JsonResponse
    {
        // Implement the method
    }

    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        // Implement the method
    }

    public function destroy(int $id): JsonResponse
    {
        // Implement the method
    }
}
