<?php

use App\Http\Controllers\Api\Facebook\FacebookCategoryController;
use App\Http\Controllers\Api\Facebook\FacebookLeadsController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    //User Endpoints
    Route::get('/list', [UserController::class, 'index']);
    Route::get('/find/{user}', [UserController::class, 'show']);
    Route::put('/update/{user}', [UserController::class, 'update']);
    Route::delete('/delete/{user}', [UserController::class, 'delete']);

    //Facebook Category Endpoint
    Route::get('/facebook-categories', [FacebookCategoryController::class, 'index']);

    //Find Facebook Leads Endpoint
    Route::post('/find-leads', [FacebookLeadsController::class, 'findLeads']);
});
