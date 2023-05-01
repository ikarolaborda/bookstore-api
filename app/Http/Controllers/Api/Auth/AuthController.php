<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService
    )
    {
        $this->middleware('auth:api', ['only' => ['logout', 'refresh']]);
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        if (isset($data['role']) && $data['role'] === 'admin') {
            $user = $request->user();
            if (!$user || $user->role !== 'admin') {
                return response()->json(['message' => 'Only admin users can create another admin user'], 403);
            }
        }
        return response()->json($this->userService->register($request->validated()), 201);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $token = $this->userService->login($credentials);

        if (!$token) {
            return response()->json(['message' => 'These credentials do not match our records.'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function logout(): JsonResponse
    {
        if (!$this->userService->logout()) {
            return response()->json(['message' => 'Could not invalidate token'], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): JsonResponse
    {
        $newToken = $this->userService->refresh();

        if (!$newToken) {
            return response()->json(['message' => 'Could not refresh token'], 401);
        }

        return response()->json(['token' => $newToken]);
    }
}
