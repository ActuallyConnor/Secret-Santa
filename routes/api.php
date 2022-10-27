<?php

use App\Http\Controllers\CreateTeamController;
use App\Http\Controllers\CreateTeamMemberController;
use App\Http\Controllers\CreateUserController;
use App\Http\Middleware\ApiKey;
use Illuminate\Http\Request;
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
    Route::post('/user', CreateUserController::class);
    Route::post('/team-member', CreateTeamMemberController::class);
    Route::post('/team', CreateTeamController::class);
});
