<?php

use App\Http\Controllers\Teams\CreateTeamController;
use App\Http\Controllers\TeamMembers\CreateTeamMemberController;
use App\Http\Controllers\Users\CreateUserController;
use App\Http\Middleware\ApiKey;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([ApiKey::class])->group(function () {
    Route::prefix('user')->group(function () {
        Route::post(null, CreateUserController::class);
    });

    Route::prefix('team-member')->group(function () {
        Route::post(null, CreateTeamMemberController::class);
    });

    Route::prefix('team')->group(function () {
        Route::post(null, CreateTeamController::class);
    });
});
