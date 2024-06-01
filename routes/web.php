<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NavbarController;


Route::get('/', [AppController::class, 'index']);

Route::get('/koleksi', [AppController::class, 'koleksi']);

Route::get('/detail/{slug}', [AppController::class, 'detail']);

// Register routes
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Login routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot password routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset password routes
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/home', function () {
    // Hanya user yang terautentikasi yang bisa mengakses halaman ini
})->middleware('auth');

// Halaman admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/blog', [BukuController::class, 'index'])->name('blog')->middleware('auth');
Route::get('/blog/create', [BukuController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/blog/store', [BukuController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('/blog/edit/{id}', [BukuController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::post('/blog/update/{id}', [BukuController::class, 'update'])->name('blog.update')->middleware('auth');
// Route::post('/blog/destroy/{id}', [BukuController::class, 'destroy'])->name('blog.destroy')->middleware('auth');

// Perbaiki rute destroy menggunakan metode DELETE
Route::delete('/blog/destroy/{id}', [BukuController::class, 'destroy'])->name('blog.destroy')->middleware('auth');

// Pencarian
Route::get('/koleksi/search', [KoleksiController::class, 'search'])->name('koleksi.search');

// Unduh Buku
Route::middleware('auth')->group(function () {
    Route::get('/bukus/download/{buku}', [BukuController::class, 'download'])->name('bukus.download');
});

// Notifikasi
Route::get('/pemberitahuan', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/pemberitahuan/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
// Route::get('/navbar', [NavbarController::class, 'index']);
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');