<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\OrderProductController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CartController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/users', UserController::class)->middleware('auth:sanctum');
Route::resource('/products', ProductController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/images', ImageController::class)->middleware('auth:sanctum');
Route::resource('/comments', CommentController::class)->middleware('auth:sanctum');
Route::resource('/carts', CartController::class)->middleware('auth:sanctum');
Route::resource('/orders', OrderController::class)->middleware('auth:sanctum');
Route::resource('/order_products', OrderProductController::class)->middleware('auth:sanctum');

Route::get('/categories/{category}/products', [ProductController::class, 'showByCategory'])->middleware('auth:sanctum');
