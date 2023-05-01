<?php

namespace Tests\Unit;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use App\Services\UserService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use Tymon\JWTAuth\JWTAuth;

class UserServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected UserRepositoryInterface $userRepository;
    protected JWTAuth $jwtAuth;
    protected UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->userRepository = $this->app->make(UserRepositoryInterface::class);
        $this->jwtAuth = $this->app->make(JWTAuth::class);
        $this->userService = new UserService($this->userRepository, $this->jwtAuth);
    }

    public function test_register_creates_user()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
        ];

        $createdUser = $this->userService->register($data);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $this->assertEquals($data['name'], $createdUser['name']);
        $this->assertEquals($data['email'], $createdUser['email']);
    }

    public function test_index_returns_users_for_admins()
    {

        $credentials = [
            'email' => 'admin@example.com',
            'password' => 'password',
        ];

        if (auth()->attempt($credentials)) {
            $token = $this->jwtAuth->attempt($credentials);
        } else {
            $this->fail('Authentication failed');
        }

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/v1/users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                [
                    'name',
                    'email',
                    'created_at',
                ]
            ],
        ]);
    }

    public function test_index_returns_forbidden_for_regular_users()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
        ];

        $createdUser = $this->userService->register($data);

        $credentials = [
            'email' => $createdUser['email'],
            'password' => 'password',
        ];

        if (auth()->attempt($credentials)) {
            $token = $this->jwtAuth->attempt($credentials);
        } else {
            $this->fail('Authentication failed');
        }

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/v1/users');

        $response->assertStatus(403);
    }

    public function test_regular_user_can_see_own_data()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
        ];

        $createdUser = $this->userService->register($data);

        $credentials = [
            'email' => $createdUser['email'],
            'password' => 'password',
        ];

        if (auth()->attempt($credentials)) {
            $token = $this->jwtAuth->attempt($credentials);
        } else {
            $this->fail('Authentication failed');
        }

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/v1/users/' . $createdUser['id']);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'name',
                'email',
                'created_at',
            ],
        ]);

    }




}
