<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Tenant\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::group(['prefix' => 'auth'], function (Router $router) {
    $router->post('login', [LoginController::class, 'login']);
    $router->post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    $router->post('register', [RegisterController::class, 'register']);
});

Route::controller(ProfileController::class)->middleware('auth:sanctum')->group(function (Router $router) {
    $router->get('profile', 'show');
});

Route::group(['prefix' => 'tenant', 'middleware' => 'auth:sanctum'], function (Router $router) {
    $router->apiResource('products', ProductController::class);
});

