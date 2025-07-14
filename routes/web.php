<?php

use App\Http\Controllers\Website\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\BkashTokenizePaymentController;
use App\Http\Controllers\SslCommerzPaymentController;

Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['as' => 'web.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Route::get('/login/{provider}', [SocialController::class, 'redirect'])->name('social.login');

    Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
    Route::get('/categories/{slug}', [HomeController::class, 'categoryByProducts'])->name('categories.products');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contactUs');
    Route::post('/contact-message', [HomeController::class, 'contactMessage'])->name('contactMessage');
    Route::post('/check-reference', [HomeController::class, 'checkReference'])->name('checkReference');

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{slug}', [ProductController::class, 'details'])->name('details');
        Route::get('/quick-view/{slug}', [ProductController::class, 'quickView'])->name('quickView');
        Route::get('/new-arrivals/ajax', [ProductController::class, 'fetchNewArrivals']);
    });

    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('view', [CartController::class, 'view'])->name('view');
        Route::get('all', [CartController::class, 'getAllCart'])->name('all');
        Route::post('add/{product_slug}', [CartController::class, 'addToCart'])->name('add');
        Route::post('update/{cart_id}', [CartController::class, 'updateCart'])->name('update');
        Route::get('remove/{cart_id}', [CartController::class, 'removeCart'])->name('remove');
        Route::get('destroy', [CartController::class, 'destroyCart'])->name('destroy');

        Route::post('quick-add-to-cart/{product_slug}', [CartController::class, 'quickAddCart'])->name('quickAddCart');
    });


    Route::post('orders/track-check', [OrderController::class, 'trackCheck'])->name('orders.trackCheck');
    Route::get('orders/{order:uuid}/track', [OrderController::class, 'trackOrder'])->name('orders.track');
    Route::resource('checkout', 'Website\OrderController');        
    Route::get('order-completed/{order_id}', [OrderController::class, 'orderCompleted'])->name('orderCompleted');
    Route::get('order-cancelled/{order_id}', [OrderController::class, 'orderCancelled'])->name('orderCancelled');
    Route::get('order-failed/{order_id}', [OrderController::class, 'orderFailed'])->name('orderFailed');
    // Bkash Tokenize Payment
    Route::resource('bkash','BkashTokenizePaymentController');
    Route::get('bkash-payment', [BkashTokenizePaymentController::class, 'index'])->name('bkashPayment');
    Route::post('bkash-payment/create', [BkashTokenizePaymentController::class, 'createPayment'])->name('bkashPayment.create');
    Route::get('bkash/callback', [BkashTokenizePaymentController::class, 'callBack'])->name('bkash.callback');


    // SSLCOMMERZ Start
// Route::get('/checkout1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/checkout1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('exampleEasyCheckout');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    Route::group(['middleware' => ['auth:web', 'verified']], function () {
        Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:web', 'verified']], function () {
            Route::get('orders', [UserController::class, 'orders'])->name('orders');
            Route::post('orders/{order}/cancel', [UserController::class, 'cancelOrder'])->name('orders.cancel');
            Route::get('wishlist', [UserController::class, 'wishlistItems'])->name('wishlist');
            Route::post('wishlist/remove/{id}', [UserController::class, 'removeWishlist'])->name('wishlist.remove');
            Route::post('compare/remove/{id}', [UserController::class, 'removeCompare'])->name('compare.remove');

            

            Route::post('wishlist/add/{id}', [UserController::class, 'addToWishlist'])->name('wishlist.add');
            Route::post('compare/add/{id}', [UserController::class, 'addToCompare'])->name('compare.add');
           Route::get('wishlist/check/{id}', [UserController::class, 'checkWishlist'])->name('wishlist.check');

           Route::get('compare', [UserController::class, 'compare'])->name('compare');

           Route::get('profile', [UserController::class, 'profile'])->name('profile');
            Route::get('point-history', [UserController::class, 'pointHistory'])->name('pointHistory');
            Route::post('withdraw-request', [UserController::class, 'withdrawRequest'])->name('withdrawRequest');
            Route::post('profile-update', [UserController::class, 'profileUpdate'])->name('profile.update');
            Route::post('password-update', [UserController::class, 'passwordUpdate'])->name('password.update');
            Route::resource('user_addresses', 'Website\UserAddressController')->except('show');
        });
    });
});

Route::get('/clear-all', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');
    Artisan::call('storage:link');
    dd('All Cleared...');
});
