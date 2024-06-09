<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

use Illuminate\Http\Request;
use App\Models\Product;

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/register', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.store');

Route::get('/products/check', function (Request $request) {
    $exists = Product::where('name', $request->query('name'))->exists();
    return response()->json(['exists' => $exists]);
});

Route::put('/update/{id}', [ProductController::class, 'update']);
Route::get('/users', [UserController::class, 'index']);

Route::get('/stocks', [ProductStockController::class, 'getAllStockItems']);
Route::get('/cart/{id}', [CartController::class, 'getAllCarts']);
Route::post('/checkout', [CartController::class, 'checkout']);

Route::delete('/cart/{id}', [CartController::class, 'deleteCart']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('products/{id?}', [ProductController::class, 'index']);
    Route::post('/cart', [CartController::class, 'addToCart']);
    Route::post('/products', [ProductStockController::class, 'addProductAndStock']);
    Route::put('/stocks/{id}', [ProductStockController::class, 'updateStock']);
    Route::delete('/products/{id}', [ProductStockController::class, 'deleteProduct']);
    Route::delete('/stocks/{id}', [ProductStockController::class, 'deleteStock']);
    Route::get('/stocks/{id}', [ProductStockController::class, 'getUserStock']);
    Route::get('/products/{id}', [ProductStockController::class, 'getProduct']);

    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id?}', [UserController::class, 'update']);
    Route::put('/users/deactivate/{id}', [UserController::class, 'deactivate']);

    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});
