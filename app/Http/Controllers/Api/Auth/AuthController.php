<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        return response()->json($this->userService->register($request->validated()), 201);
    }
}
