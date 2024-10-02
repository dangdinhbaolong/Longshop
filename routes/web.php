<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/product/delete/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.delete');
    Route::get('admin/product', [AdminProductController::class, 'index'])->name('admin.product');
    Route::resource('/admin/products', AdminProductController::class);
    Route::resource('/admin/orders', AdminOrderController::class);
    Route::resource('/admin/users', AdminUserController::class);
    Route::get('admin/user/delete/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.delete');
    Route::put('/admin/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::put('/admin/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('introduce',function (){
        return view('introduce');
    })->name('introduce');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('cart/show', [CartProductController::class, 'show'])->name('cart.show');
    Route::get('cart/add/{id}', [CartProductController::class, 'add'])->name('cart.add');
    Route::get('cart/remove/{rowId}', [CartProductController::class, 'remove'])->name('cart.remove');
    Route::get('cart/destrpy', [CartProductController::class, 'destroy'])->name('cart.destroy');
    Route::post('cart/update', [CartProductController::class, 'update'])->name('cart.update');
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::get('/order/dilivered', [OrderController::class, 'dilivered'])->name('order.dilivered');
    Route::get('/order/complete', [OrderController::class, 'complete'])->name('order.complete');
    Route::get('/order/show/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');

    Route::get('/payment/momo/{order}', [PaymentController::class, 'createMoMoPayment'])->name('payment.momo');
    Route::get('/momo/return', [PaymentController::class, 'handleMoMoReturn'])->name('momo.return');

    // Route for MoMo IPN (Instant Payment Notification) URL
    Route::get('/momo/ipn', [PaymentController::class, 'handleMoMoIpn'])->name('momo.ipn');

    // Route for order success page
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

    // Route for order failure page
    Route::get('/order/failed', [OrderController::class, 'failed'])->name('order.failed');
});

require __DIR__ . '/auth.php';
