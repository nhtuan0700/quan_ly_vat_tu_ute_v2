<?php

use App\Http\Controllers\{
    HomeController,
    PermissionController,
    UserController,
    VanPhongPhamController
};
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => 'acl:user-manage'], function() {
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('search', [UserController::class, 'search'])->name('search');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('create', [UserController::class, 'store'])->name('store');
        Route::get('edit/{id?}', [UserController::class, 'edit'])->name('edit');
        Route::put('update/{id?}', [UserController::class, 'update'])->name('update');
        Route::get('reset-password/{id}', [UserController::class, 'showFormResetPassword'])->name('reset_password');
        Route::put('reset-password/{id}', [UserController::class, 'resetPassword']);
    });

    Route::group(['as' => 'permission.', 'prefix' => 'permission', 'middleware' => 'acl:permission-edit'], function() {
        Route::get('index/{id_role?}', [PermissionController::class, 'index'])->name('index');
        Route::put('update/{id_role?}', [PermissionController::class, 'update'])->name('update');
    });

    Route::group(['as' => 'vpp.', 'prefix' => 'van-phong-pham'], function() {
        Route::get('/', [VanPhongPhamController::class, 'index'])->name('index');
    });
});
