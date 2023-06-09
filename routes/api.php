<?php

use App\Http\Controllers\Api\Auth\AuthController;
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
        Route::prefix('auth')->group(
            function () {
                Route::post('register', [AuthController::class, 'register']);
                Route::post('login', [AuthController::class, 'login']);

                Route::group(['middleware' => 'jwt.auth'], function () {
                    Route::post('refresh', [AuthController::class, 'refresh']);
                    Route::post('logout', [AuthController::class, 'logout']);
                });
            }
        );

        Route::middleware(['auth:api'])->group(function () {
            Route::apiResource('users', UserController::class);
            Route::apiResource('books', BookController::class);
        });
    }
)->middleware('json');
