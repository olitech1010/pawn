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
    // User Management
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users/profile', [AuthController::class, 'profile']);
    Route::patch('/users/profile', [AuthController::class, 'updateProfile']);

    // Item Management
    Route::post('/items', [ItemController::class, 'store']);
    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items/{id}', [ItemController::class, 'show']);
    Route::patch('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy']);

    // Category Management
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::patch('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // SubCategory Management
    Route::post('/categories/{categoryId}/subcategories', [SubCategoryController::class, 'store']);
    Route::patch('/subcategories/{id}', [SubCategoryController::class, 'update']);
    Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy']);

    // Transaction Management
    Route::get('/transactions', [TransactionController::class, 'index']); // List user transactions
    Route::get('/transactions/{id}', [TransactionController::class, 'show']); // View a specific transaction
    Route::post('/transactions', [TransactionController::class, 'store']); // Create a new transaction
    Route::patch('/transactions/{id}', [TransactionController::class, 'update']); // Update a transaction's status

    // Notification Management
    Route::get('/notifications', [NotificationController::class, 'index']); // List notifications for the user
    Route::get('/notifications/{id}', [NotificationController::class, 'show']); // View a specific notification
    Route::patch('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']); // Mark notification as read

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
