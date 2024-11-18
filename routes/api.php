<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MarketplaceController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('items', ItemController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('transactions', TransactionController::class);

    // User Management
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users/profile', [AuthController::class, 'profile']);
    Route::patch('/users/profile', [AuthController::class, 'updateProfile']);

    // Category Management
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::patch('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // SubCategory Management
    Route::post('/categories/{categoryId}/subcategories', [SubCategoryController::class, 'store']);
    Route::patch('/subcategories/{id}', [SubCategoryController::class, 'update']);
    Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy']);

    // Marketplace Routes
    Route::get('/marketplace', [MarketplaceController::class, 'index']);
    Route::get('/marketplace/{id}', [MarketplaceController::class, 'show']);
    Route::post('/admin/marketplace/{itemId}/list', [MarketplaceController::class, 'listItem']);
    Route::delete('/admin/marketplace/{itemId}/remove', [MarketplaceController::class, 'removeItem']);
});

// Admin Route to send notifications
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::post('/notifications', [NotificationController::class, 'store']); // Send custom notification
});
