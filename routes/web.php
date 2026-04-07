<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::all()->groupBy('category');
    return view('welcome', compact('products'));
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('{product}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('{product}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('{product}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });
});
