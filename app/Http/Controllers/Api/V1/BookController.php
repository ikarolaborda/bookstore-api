<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\BookServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{

    public function __construct(
        protected readonly BookServiceInterface $bookService
    )
    {
        $this->middleware(['auth:api', 'admin'])->only(['store','update','destroy']);
        $this->middleware(['auth:api'])->only(['index','show']);
    }

    public function index(): JsonResponse
    {
        return response()->json(['data' => BookResource::collection($this->bookService->getAll())],200);
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        return response()->json(['data' => BookResource::make($this->bookService->create($request->validated()))],201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(['data' => BookResource::make($this->bookService->getById($id))],200);
    }

    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        return response()->json(['data' => $this->bookService->update($id, $request->validated())],202);
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json(
            ['message' => 'removed book with id'. $id,
            'success' => $this->bookService->delete($id)],
            204);
    }
}
