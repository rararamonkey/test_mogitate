<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 一覧
Route::get('/', [ProductController::class, 'index'])
    ->name('products.index');

// 詳細
Route::get('/products/detail/{id}', [ProductController::class, 'show'])
    ->name('products.show');

// 登録画面
Route::get('/products/register', [ProductController::class, 'create'])
    ->name('products.create');

// 登録処理
Route::post('/products/store', [ProductController::class, 'store'])
    ->name('products.store');

// 更新
Route::put('/products/{id}/update', [ProductController::class, 'update'])
    ->name('products.update');

// 削除
Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])
    ->name('products.destroy');