<?php

use Illuminate\Support\Facades\Route;
use Inovector\ProductManager\Http\Controllers\ProductController;
use Inovector\ProductManager\Http\Controllers\CategoryController;
use Inovector\ProductManager\Http\Controllers\SellerController;

Route::view('/product-manager', 'product-manager::app');

Route::get('/product-manager/products', [ProductController::class, 'index']);
Route::get('/product-manager/categories', [CategoryController::class, 'index']);
Route::get('/product-manager/sellers', [SellerController::class, 'index']);

Route::post('/product-manager/export', [ProductController::class, 'export']);
Route::get('/product-manager/exports/{filename}', function ($filename) {
    $path = public_path('storage/exports/' . $filename);
    if (!file_exists($path)) abort(404);
    return response()->download($path);
});

Route::post('/product-manager/import', [ProductController::class, 'import']);



