<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected JWTAuth                 $jwtAuth
    )
    {
        parent::__construct($userRepository);
    }

    public function register(array $attributes): array
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return $this->userRepository->create($attributes)->toArray();
    }

    /**
     * @throws JWTException
     */
    public function login(array $credentials): ?string
    {
        try {
            if (!$token = $this->jwtAuth->attempt($credentials)) {
                return null;
            }
        } catch (JWTException $e) {
            throw new JWTException('Could not create token');
        }

        return $token;
    }

    public function logout(): bool
    {
        try {
            $this->jwtAuth->invalidate($this->jwtAuth->getToken());
            return true;
        } catch (JWTException $e) {
            return false;
        }
    }

    public function refresh(): ?string
    {
        try {
            $newToken = $this->jwtAuth->refresh($this->jwtAuth->getToken());
        } catch (JWTException $e) {
            return null;
        }

        return $newToken;
    }
}
