<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

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
    Route::resource('orders', 'OrderController')->only('index', 'show', 'update', 'destroy');

    Route::delete('products/image/delete/{image_id}', 'ProductController@imageDelete')->name('products.imageDelete');
    Route::post('products/sortable', 'ProductController@sortable')->name('products.sortable');
    Route::resource('products', 'ProductController');
    Route::resource('sliders', 'SliderController');
    Route::get('agents/withdraw-request', 'AgentController@withdrawRequest')->name('agents.withdrawRequest');
    Route::post('agents/withdraw-request/{id}', 'AgentController@withdrawRequestUpdate')->name('agents.withdrawRequestUpdate');
    Route::resource('agents', 'AgentController');

    Route::get('setting', 'SettingController@index')->name('setting');
    Route::post('update-update', 'SettingController@update')->name('setting.update');

    Route::get('contact-message', 'ContactMessageController@index')->name('contactMessage.index');
    Route::delete('contact-message/{id}/destroy', 'ContactMessageController@destroy')->name('contactMessage.destroy');

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('orders', [ReportController::class, 'orders'])->name('orders');
        Route::get('ledger', [ReportController::class, 'ledger'])->name('ledger');
    });
});


