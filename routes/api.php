<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MarketplaceController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    // User Management
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users/profile', [AuthController::class, 'profile']);
    Route::patch('/users/profile', [AuthController::class, 'updateProfile']);

    // Item Management
    Route::post('/items', [ItemController::class, 'store']);
    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items/{id}', [ItemController::class, 'show']);
    Route::patch('/items/{id}', [ItemController::class, 'update']);

    Route::middleware('auth:sanctum')->group(function () {
    Route::post('/items', [ItemController::class, 'store']);
    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items/{id}', [ItemController::class, 'show']);
    Route::patch('/items/{id}', [ItemController::class, 'update']);
});


    // Category Management
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/admin/categories', [CategoryController::class, 'store']);
    Route::patch('/admin/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']);

    // Transaction Management
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);

    // Notification System
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::patch('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);

    // Marketplace
    Route::get('/marketplace', [MarketplaceController::class, 'index']);
    Route::get('/marketplace/{id}', [MarketplaceController::class, 'show']);
});

