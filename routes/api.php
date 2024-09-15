<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TaskController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'v1'], function() {
    /**
     * route "/register"
     * @method "POST"
     */
    Route::post('/register', RegisterController::class)->name('register');
    
    /**
     * route "/login"
     * @method "POST"
     */
    Route::post('/login', LoginController::class)->name('login');

    /**
     * route "/user"
     * @method "GET"
     */
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::middleware('auth:api')->group(function() {
        Route::apiResource('tasks', TaskController::class);
    });

    /**
     * route "/logout"
     * @method "POST"
     */
    Route::post('/logout', LogoutController::class)->name('logout');
});

