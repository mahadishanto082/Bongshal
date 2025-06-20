<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\WriterController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Admin Auth Routes with prefix and namespace
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin\Auth'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');          // admin.login (GET)
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');          // admin.login.submit (POST)
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');              // admin.logout (POST)
});

// Admin routes with auth middleware and prefix
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'home'])->name('dashboard');

    // Admin profile
    Route::get('profile-update', [AdminController::class, 'showProfileUpdateForm'])->name('profile.update');
    Route::post('profile-update', [AdminController::class, 'profileUpdate'])->name('profile.update.submit');
    Route::get('profile-settings', [AdminController::class, 'settings'])->name('profile.settings');
    Route::post('password-update', [AdminController::class, 'passwordUpdate'])->name('password.update');
    Route::post('email-update', [AdminController::class, 'emailUpdate'])->name('email.update');

    // Resources
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('writers', WriterController::class);
    Route::resource('merchants', MerchantController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);

    // Products specific routes
    Route::delete('products/image/delete/{image_id}', [ProductController::class, 'imageDelete'])->name('products.imageDelete');
    Route::post('products/sortable', [ProductController::class, 'sortable'])->name('products.sortable');
    Route::resource('products', ProductController::class);

    // Sliders
    Route::resource('sliders', SliderController::class);

    // Agents withdraw requests
    Route::get('agents/withdraw-request', [AgentController::class, 'withdrawRequest'])->name('agents.withdrawRequest');
    Route::post('agents/withdraw-request/{id}', [AgentController::class, 'withdrawRequestUpdate'])->name('agents.withdrawRequestUpdate');
    Route::resource('agents', AgentController::class);

    // Settings
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::post('setting/update', [SettingController::class, 'update'])->name('setting.update');

    // Contact messages
    Route::get('contact-message', [ContactMessageController::class, 'index'])->name('contactMessage.index');
    Route::delete('contact-message/{id}/destroy', [ContactMessageController::class, 'destroy'])->name('contactMessage.destroy');

    // Reports group
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('orders', [ReportController::class, 'orders'])->name('orders');
        Route::get('ledger', [ReportController::class, 'ledger'])->name('ledger');
    });
});
