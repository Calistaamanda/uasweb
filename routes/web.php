<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);

Route::get('/koleksi', [AppController::class, 'koleksi']);

Route::get('/detail/{slug}', [AppController::class, 'detail']);

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/blog', [BukuController::class, 'index'])->name('blog')->middleware('auth');
Route::get('/blog/create', [BukuController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/blog/store', [BukuController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('/blog/edit/{id}', [BukuController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::post('/blog/update/{id}', [BukuController::class, 'update'])->name('blog.update')->middleware('auth');
Route::post('/blog/destroy/{id}', [BukuController::class, 'destroy'])->name('blog.destroy')->middleware('auth');
