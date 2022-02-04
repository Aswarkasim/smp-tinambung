<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AdminCategoryPostController;
use App\Http\Controllers\AdminConfigurationController;
use App\Http\Controllers\AdminEkskulController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\AdminSiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);



Route::prefix('/admin/auth')->group(function () {
    Route::get('/', [AdminAuthController::class, 'index'])->middleware('guest');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::get('/register', [AdminAuthController::class, 'register']);
    Route::post('/doRegister', [AdminAuthController::class, 'doRegsiter']);
    Route::get('/logout', [AdminAuthController::class, 'logout']);
});


Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', function () {
        $data = [
            'content' => 'admin/dashboard/index'
        ];
        return view('admin/layouts/wrapper', $data);
    });

    Route::resource('/user', AdminUserController::class);

    Route::get('/konfigurasi', [AdminConfigurationController::class, 'index']);
    Route::put('/konfigurasi/update', [AdminConfigurationController::class, 'update']);

    Route::resource('/banner', AdminBannerController::class);
    Route::resource('/galeri', AdminGaleriController::class);
    Route::resource('/ekskul', AdminEkskulController::class);
    Route::resource('/siswa', AdminSiswaController::class);


    Route::prefix('/posts')->group(function () {
        Route::resource('/post', AdminPostController::class);
        Route::resource('/kategori', AdminCategoryPostController::class);
    });
});

Route::prefix('/home')->group(function () {
    // Route::resource('/mitra', HomeMitraController::class);;
    // Route::resource('/layanan', HomeLayananController::class);;
});
