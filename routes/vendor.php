<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VendorRegisterController; // adjust if needed
use App\Http\Controllers\Auth\VendorLoginController; // if you have it
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\ProductController; // add this line

Route::middleware('guest:vendor')->group(function () {
    Route::get('login', [VendorLoginController::class, 'showLoginForm'])->name('login');
    
    Route::post('login', [VendorLoginController::class, 'login'])->name('login.submit');

    Route::get('register', [VendorRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [VendorRegisterController::class, 'register'])->name('register.submit');
});

Route::middleware('auth:vendor')->group(function () {
     Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
     Route:: get('create-product', [VendorDashboardController::class, 'createProduct'])->name('products.create');
    Route::post('logout', [VendorLoginController::class, 'logout'])->name('logout');
    // Route::get('profile', [VendorDashboardController::class, 'profile'])->name('profile');

    // Route::post('profile/update', [VendorDashboardController::class, 'updateProfile'])->name('profile.update');
     

    
   
    Route::resource('products', ProductController::class);
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::post('products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('orders', [VendorDashboardController::class, 'orders'])->name('orders');
    Route::get('orders/{order}', [VendorDashboardController::class, 'viewOrder'])->name('orders.view');
    // Route::post('delete-product/{product}', [ProductController::class, 'delete'])->name('products.delete');
    
});

// Route::group(['middleware' => ['auth:vendor']], function () {
//     Route::get('dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');

//     Route::get('profile', [VendorController::class, 'profile'])->name('vendor.profile');
//     Route::post('profile/update', [VendorController::class, 'updateProfile'])->name('vendor.profile.update');

//     Route::resource('products', ProductController::class);

//     Route::get('orders', [VendorController::class, 'orders'])->name('vendor.orders');
//     Route::get('orders/{order}', [VendorController::class, 'viewOrder'])->name('vendor.orders.view');

//     Route::post('products/{product}/status', [ProductController::class, 'updateStatus'])->name('vendor.products.status');
// });