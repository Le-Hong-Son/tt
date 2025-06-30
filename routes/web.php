<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/checkout', [CartController::class, 'showCheckoutForm'])->name('cart.checkout.form');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});


// Client
use App\Http\Controllers\Client\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('client.home');

use App\Http\Controllers\Client\CategoryController;

Route::get('/danh-muc/{id}', [CategoryController::class, 'show'])->name('client.categories.show');

use App\Http\Controllers\OrderHistoryController;

Route::middleware('auth')->group(function () {
    Route::get('/orders/history', [OrderHistoryController::class, 'index'])->name('orders.history');
    Route::get('/lich-su-don-hang', [OrderHistoryController::class, 'index'])->name('client.orders.history');
    Route::get('/lich-su-don-hang/{id}', [OrderHistoryController::class, 'show'])->name('client.orders.show');
    Route::put('/orders/{order}/cancel', [OrderHistoryController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{order}/reorder', [OrderHistoryController::class, 'reorder'])->name('orders.reorder');
});


// Chi tiết sản phẩm
use App\Http\Controllers\Client\ProductController;

Route::get('/san-pham/{id}', [ProductController::class, 'show'])->name('client.products.show');

// comment

//Route::post('/comments', [\App\Http\Controllers\Client\CommentController::class, 'store'])->name('comments.store')->middleware('auth');


// Trang admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::resource('comments', \App\Http\Controllers\CommentController::class);
});
// Route comment cho client (bình luận sản phẩm)
use App\Http\Controllers\Client\CommentController;

Route::middleware(['auth'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});
