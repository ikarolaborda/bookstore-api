<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(
    function () {
        Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
            Route::post('login', [UserController::class, 'login']);
            Route::post('register', [UserController::class, 'register']);
            Route::post('logout', [UserController::class, 'logout']);
            Route::post('refresh', [UserController::class, 'refresh']);
            Route::get('user-profile', [UserController::class, 'userProfile']);
        });

        Route::middleware(['auth:api'])->group(function () {
            Route::apiResource('users', UserController::class);
            Route::apiResource('books', BookController::class);
        });
    }
);
