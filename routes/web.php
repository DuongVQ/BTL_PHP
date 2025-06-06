<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/myorders', [HomeController::class, 'myorders'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth', 'admin']);

route::post('add_category', [AdminController::class, 'add_category'])->middleware(['auth', 'admin']);

route::get('view_category/{id?}', [AdminController::class, 'view_category'])->middleware(['auth', 'admin']);

route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth', 'admin']);

route::get('view_product', [AdminController::class, 'view_product'])->middleware(['auth', 'admin']);

route::get('add_product', [AdminController::class, 'add_product'])->middleware(['auth', 'admin']);

route::post('upload_product', [AdminController::class, 'upload_product'])->middleware(['auth', 'admin']);

route::get('update_product/{id}', [AdminController::class, 'update_product'])->middleware(['auth', 'admin']);

route::post('edit_product/{id}', [AdminController::class, 'edit_product'])->middleware(['auth', 'admin']);

route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->middleware(['auth', 'admin']);

route::get('product_search', [AdminController::class, 'product_search'])->middleware(['auth', 'admin']);

Route::controller(HomeController::class)->group(function () {

    Route::get('stripe', 'stripe');

    Route::post('stripe', 'stripePost')->name('stripe.post');
});

route::get('view_orders', [AdminController::class, 'view_orders'])->middleware(['auth', 'admin']);

Route::post('admin/update_order_status/{id}', [AdminController::class, 'update_order_status'])->middleware(['auth', 'admin']);

Route::get('admin/orders/pdf', [AdminController::class, 'orders_pdf'])->middleware(['auth', 'admin']);

// client
route::get('product_detail/{id}', [HomeController::class, 'product_detail']);

Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');

Route::delete('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');

route::get('mycart', [HomeController::class, 'mycart'])->middleware(['auth', 'verified']);

route::post('confirm_order', [HomeController::class, 'confirm_order'])->middleware(['auth', 'verified']);

Route::post('/cancel_order/{id}', [HomeController::class, 'cancel_order'])->name('cancel_order');

route::get('shop', [HomeController::class, 'shop'])->name('shop');

Route::put('cart/update/{id}', [HomeController::class, 'update']);

Route::delete('cart/delete/{id}', [HomeController::class, 'destroy']);
