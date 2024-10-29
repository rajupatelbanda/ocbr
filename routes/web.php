<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\FrontEndController;

// Frontend Routes
Route::get("/", [FrontEndController::class, "index"])->name("index");
Route::get("/category/{slug}", [FrontEndController::class, "categoryPage"]);
Route::get("/all-products-list", [FrontEndController::class, "productList"]);
Route::get("/product-detail/{product_name}", [FrontEndController::class, "productDetail"]);

// Cart Routes
Route::post('/cart/add/{product_id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{cart_id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{cart_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

// Checkout & Order Routes
Route::get('/checkout', [OrderController::class, 'index']);
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
Route::get('/order/failed', [OrderController::class, 'failed'])->name('order.failed');

// PayPal Routes
Route::get('/paypal/payment/{order}', [PayPalController::class, 'processPayment'])->name('paypal.payment');
Route::get('/paypal/success/{orderId}', [PayPalController::class, 'successPayment'])->name('paypal.success');
Route::get('/paypal/cancel/{orderId}', [PayPalController::class, 'cancelPayment'])->name('paypal.cancel');

// User Authentication Routes
Route::get('/user-login', [OrderController::class, 'userLogin'])->name('user.login');
Route::get('/user-register', [OrderController::class, 'userRegister'])->name('user.register');

// Auth routes for Guests
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
    Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
    Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
    Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');
});

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
    Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Resource routes for Categories and Products
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

// Redirect if already logged in and trying to access login page
Route::get('/login', function () {
    return redirect('/dashboard');
})->middleware('auth');

