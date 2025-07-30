<?php

use App\Http\Controllers\Api\Facebook\FacebookLeadsController;
use App\Http\Controllers\Kartra\KartraController;
use App\Http\Controllers\UserRoles\UserRolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/update-free-users', [KartraController::class, 'updateFreeUserPermissions']);
Route::get('/update-freelance-users', [KartraController::class, 'updateFreelanceUserPermissions']);

Route::post('/kartra-agency', [KartraController::class, 'agency']);
Route::post('/kartra-pro', [KartraController::class, 'pro']);
Route::post('/kartra-form-pro', [KartraController::class, 'proForm']);
Route::post('/kartra-freelance', [KartraController::class, 'freelancer']);
Route::post('/kartra-free', [KartraController::class, 'free']);
Route::post('/kartra-cancel', [KartraController::class, 'cancel']);

Route::group(['prefix' => 'users'], function () {
    require 'user/authenticated.php';
    require 'user/unauthenticated.php';
});
