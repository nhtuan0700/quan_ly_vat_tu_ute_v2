<?php

use App\Http\Controllers\{
    DangKyVanPhongPhamController,
    DotDangKyController,
    HomeController,
    PhieuMuaController,
    PhieuSuaController,
    ThietBiController,
    UserController,
    VanPhongPhamController
};
use App\Http\Controllers\Auth\LoginController;
use App\Models\DangKyVanPhongPham;
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
        Route::get('export', [UserController::class, 'export_excel'])->name('export');
        Route::get('download-template', [UserController::class, 'download_template'])->name('download_template');
        Route::post('import', [UserController::class, 'import_excel'])->name('import');
        Route::post('update-hanmuc/{id_user}', [UserController::class, 'updateHanMuc'])->name('update_hanmuc');
    });

    Route::group(['as' => 'vanphongpham.', 'prefix' => 'van-phong-pham', 'middleware' => 'acl:vattu-manage'], function() {
        Route::get('/', [VanPhongPhamController::class, 'index'])->name('index');
        Route::get('/tim-kiem', [VanPhongPhamController::class, 'search'])->name('search');
        Route::get('/create', [VanPhongPhamController::class, 'create'])->name('create');
        Route::post('/create', [VanPhongPhamController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [VanPhongPhamController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [VanPhongPhamController::class, 'update'])->name('update');
        Route::delete('/delete/{id?}', [VanPhongPhamController::class, 'delete'])->name('delete');
        Route::get('export', [VanPhongPhamController::class, 'export_excel'])->name('export');
        Route::get('download-template', [VanPhongPhamController::class, 'download_template'])->name('download_template');
        Route::post('import', [VanPhongPhamController::class, 'import_excel'])->name('import');
    });

    Route::group(['as' => 'thietbi.', 'prefix' => 'thiet-bi', 'middleware' => 'acl:vattu-manage'], function() {
        Route::get('/', [ThietBiController::class, 'index'])->name('index');
        Route::get('/tim-kiem', [ThietBiController::class, 'search'])->name('search');
        Route::get('/create', [ThietBiController::class, 'create'])->name('create');
        Route::post('/create', [ThietBiController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [ThietBiController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [ThietBiController::class, 'update'])->name('update');
        // Route::delete('/delete/{id?}', [ThietBiController::class, 'delete'])->name('delete');
        Route::get('export', [ThietBiController::class, 'export_excel'])->name('export');
        Route::get('download-template', [ThietBiController::class, 'download_template'])->name('download_template');
        Route::post('import', [ThietBiController::class, 'import_excel'])->name('import');
    });
    Route::get('thiet-bi/list_ajax', [ThietBiController::class, 'list_ajax'])->name('thietbi.list_ajax');

    
    Route::group(['as' => 'dotdangky.', 'prefix' => 'dot-dang-ky', 'middleware' => 'acl:dk-manage'], function() {
        Route::get('/', [DotDangKyController::class, 'index'])->name('index');
        Route::get('/create', [DotDangKyController::class, 'create'])->name('create');
        Route::post('/create', [DotDangKyController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [DotDangKyController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [DotDangKyController::class, 'update'])->name('update');
        Route::delete('/delete/{id?}', [DotDangKyController::class, 'delete'])->name('delete');
    });

    Route::group(['as' => 'dangky_vpp.', 'prefix' => 'dk-vpp'], function() {
        Route::get('/', [DangKyVanPhongPhamController::class, 'index'])->name('index');
        Route::post('/save', [DangKyVanPhongPhamController::class, 'save'])->name('save');
    });

    Route::group(['as' => 'history.', 'prefix' => 'lich-su-dang-ky'], function() {
        Route::get('/dot-dang-ky/{id_dotdk?}', [DangKyVanPhongPhamController::class, 'history'])->name('index');
    });

    Route::group(['as' => 'phieumua.', 'prefix' => 'phieu-mua', 'middleware' => 'acl:phieumua-manage'], function() {
        Route::get('/', [PhieuMuaController::class, 'index'])->name('index');
        Route::get('/create/{id_dotdk}', [PhieuMuaController::class, 'create'])->name('create');
        Route::get('/dot-dang-ky', [PhieuMuaController::class, 'list_dot_dang_ky'])->name('dot_dk');
        Route::post('/create/{id_dotdk}', [PhieuMuaController::class, 'store'])->name('store');
        Route::get('/detail/{id?}', [PhieuMuaController::class, 'detail'])->name('detail');
        Route::get('/search', [PhieuMuaController::class, 'search'])->name('search');
    });

    Route::group(['as' => 'phieusua.', 'prefix' => 'phieu-sua'], function() {
        Route::get('/', [PhieuSuaController::class, 'index'])->name('index');
        Route::get('/create', [PhieuSuaController::class, 'create'])->name('create');
        Route::post('/create', [PhieuSuaController::class, 'store'])->name('store');
        Route::get('/detail/{id?}', [PhieuSuaController::class, 'detail'])->name('detail');
        Route::get('/edit/{id?}', [PhieuSuaController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [PhieuSuaController::class, 'update'])->name('update');
        Route::get('/search', [PhieuSuaController::class, 'search'])->name('search');
        Route::delete('/delete/{id?}', [PhieuSuaController::class, 'delete'])->name('delete');
    });
});
