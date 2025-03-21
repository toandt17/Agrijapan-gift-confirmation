<?php

use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherRedemptionController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes cho Người dùng
Route::get('/voucher/{code}', [VoucherController::class, 'show'])->name('voucher.show');
Route::get('/voucher/share/{code}', [VoucherController::class, 'share'])->name('voucher.share');

// Routes cho Đại lý
Route::get('/verify/{code?}', [VoucherController::class, 'verify'])->name('voucher.verify');
Route::post('/verify', [VoucherController::class, 'check'])->name('voucher.check');
Route::post('/redeem', [VoucherRedemptionController::class, 'redeem'])->name('voucher.redeem');
Route::get('/redeemed/{code}', [VoucherRedemptionController::class, 'redeemed'])->name('voucher.redeemed');

// Routes cho Admin - Thêm middleware auth và checkAdmin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('vouchers', AdminVoucherController::class);
});
