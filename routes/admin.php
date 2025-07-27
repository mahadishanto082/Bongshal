<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\OrderApprovalController;
use App\Http\Controllers\Admin\ProductApprovalController;

# Admin auth routes...
Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

# Admin middleware:admin routes...
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('dashboard', 'DashboardController@home')->name('dashboard');
    Route::get('profile-update', [AdminController::class, 'showProfileUpdateForm'])->name('profile.update');
    Route::post('profile-update', [AdminController::class, 'profileUpdate']);
    Route::get('profile-settings', [AdminController::class, 'settings'])->name('profile.settings');
    Route::post('password-update', [AdminController::class, 'passwordUpdate'])->name('password.update');
    Route::post('email-update', [AdminController::class, 'emailUpdate'])->name('email.update');

    # All resource routes...
    Route::resource('categories', 'CategoryController');
    Route::resource('brands', 'BrandController');
    Route::resource('writers', 'WriterController');
    Route::resource('merchants', 'MerchantController');
   Route::resource('approval', 'ProductApprovalController');
     Route::get('approval', [ProductApprovalController::class, 'index'])->name('approval.index');
    Route::post('approval/{product}/approve', [ProductApprovalController::class, 'approve'])->name('approval.approve');
    Route::post('approval/{product}/reject', [ProductApprovalController::class, 'reject'])->name('approval.reject');
    // Route::post('approval/{product}/approve', [ProductApprovalController::class, 'approve'])->name('approval.approve');
    
     Route::resource('orders', 'OrderController')->only('index', 'show', 'update', 'destroy');

    Route::delete('products/image/delete/{image_id}', 'ProductController@imageDelete')->name('products.imageDelete');
    Route::post('products/sortable', 'ProductController@sortable')->name('products.sortable');
    Route::resource('products', 'ProductController');
    // Route::resource('approval','OrderApprovalController');

    // Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    //     Route::get('/order-approvals', [App\Http\Controllers\Admin\OrderApprovalController::class, 'index'])->name('order_approval.index');
    //     Route::put('/order-approvals/{id}/approve', [App\Http\Controllers\Admin\OrderApprovalController::class, 'approve'])->name('order_approval.approve');
    //     Route::put('/order-approvals/{id}/reject', [App\Http\Controllers\Admin\OrderApprovalController::class, 'reject'])->name('order_approval.reject');
    // });
    
    // Route::prefix('admin/product')->name('admin.product.')->group(function () {
    //     Route::get('approval', [OrderApprovalController::class, 'index'])->name('approval.index');
    //     Route::post('approval/{product}/approve', [OrderApprovalController::class, 'approve'])->name('approval.approve');
    //     Route::post('approval/{product}/reject', [OrderApprovalController::class, 'reject'])->name('approval.reject');
    // });
    
   
    Route::resource('sliders', 'SliderController');
    Route::get('agents/withdraw-request', 'AgentController@withdrawRequest')->name('agents.withdrawRequest');
    Route::post('agents/withdraw-request/{id}', 'AgentController@withdrawRequestUpdate')->name('agents.withdrawRequestUpdate');
    Route::resource('agents', 'AgentController');
    Route::resource('WelcomeTexts', 'WelcomeTextController');

    Route::resource('banners', 'BannerController');

    Route::get('setting', 'SettingController@index')->name('setting');
    Route::post('update-update', 'SettingController@update')->name('setting.update');

    Route::get('contact-message', 'ContactMessageController@index')->name('contactMessage.index');
    Route::delete('contact-message/{id}/destroy', 'ContactMessageController@destroy')->name('contactMessage.destroy');

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('orders', [ReportController::class, 'orders'])->name('orders');
        Route::get('ledger', [ReportController::class, 'ledger'])->name('ledger');
    });
    
});


