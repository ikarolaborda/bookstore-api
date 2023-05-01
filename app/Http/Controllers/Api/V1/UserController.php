<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\UserServiceInterface;
use App\Helpers\UserRoleHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserServiceInterface $userService
    )
    {
        $this->middleware(['auth:api', 'admin'])->only(['index','store','update','destroy']);
        $this->middleware(['auth:api'])->only(['show']);
    }

    public function index(): JsonResponse
    {
        return response()->json(['data' => UserResource::collection($this->userService->getAll())],200);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        if (isset($data['role']) && $data['role'] === 'admin') {
            $user = $request->user();
            if (!UserRoleHelper::canCreateAdmin($request)) {
                return response()->json(['message' => 'Only admin users can create another admin user'], 403);
            }
        }

        return response()->json(['data' => $this->userService->register($request->validated())],201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(['data' => $this->userService->getById($id)],200);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        return response()->json(['data' => $this->userService->update($id, $request->validated())],202);
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json(
            ['message' => 'removed user with id'. $id,
            'success' => $this->userService->delete($id)],
            204);
    }
}
