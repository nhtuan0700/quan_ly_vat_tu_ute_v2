<?php

use App\Http\Controllers\{
    ProcessNoteController,
    EquipmentController,
    HomeController,
    PeriodRegistrationController,
    BuyNoteController,
    FixNoteController,
    RegistrationController,
    StationeryController,
    UserController,
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

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => 'acl:user-manage'], function () {
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
        Route::post('update-hanmuc/{id_user}', [UserController::class, 'updateLimit'])->name('update_limit')
            ->middleware('acl:limit-manage');
    });

    Route::group(['as' => 'stationery.', 'prefix' => 'van-phong-pham', 'middleware' => 'acl:supplies-manage'], function () {
        Route::get('/', [StationeryController::class, 'index'])->name('index');
        Route::get('/tim-kiem', [StationeryController::class, 'search'])->name('search');
        Route::get('/create', [StationeryController::class, 'create'])->name('create');
        Route::post('/create', [StationeryController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [StationeryController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [StationeryController::class, 'update'])->name('update');
        Route::delete('/delete/{id?}', [StationeryController::class, 'delete'])->name('delete');
        Route::get('export', [StationeryController::class, 'export_excel'])->name('export');
        Route::get('download-template', [StationeryController::class, 'download_template'])->name('download_template');
        Route::post('import', [StationeryController::class, 'import_excel'])->name('import');
    });

    Route::group(['as' => 'equipment.', 'prefix' => 'thiet-bi', 'middleware' => 'acl:supplies-manage'], function () {
        Route::get('/', [EquipmentController::class, 'index'])->name('index');
        Route::get('/tim-kiem', [EquipmentController::class, 'search'])->name('search');
        Route::get('/create', [EquipmentController::class, 'create'])->name('create');
        Route::post('/create', [EquipmentController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [EquipmentController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [EquipmentController::class, 'update'])->name('update');
        Route::get('export', [EquipmentController::class, 'export_excel'])->name('export');
        Route::get('download-template', [EquipmentController::class, 'download_template'])->name('download_template');
        Route::post('import', [EquipmentController::class, 'import_excel'])->name('import');
    });
    Route::get('thiet-bi/list_ajax', [EquipmentController::class, 'list_ajax'])->name('equipment.list_ajax');


    Route::group(['as' => 'period.', 'prefix' => 'dot-dang-ky', 'middleware' => 'acl:period-manage'], function () {
        Route::get('/', [PeriodRegistrationController::class, 'index'])->name('index');
        Route::get('/create', [PeriodRegistrationController::class, 'create'])->name('create');
        Route::post('/create', [PeriodRegistrationController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [PeriodRegistrationController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [PeriodRegistrationController::class, 'update'])->name('update');
        Route::delete('/delete/{id?}', [PeriodRegistrationController::class, 'delete'])->name('delete');
    });

    Route::group(['as' => 'registration.', 'prefix' => 'dang-ky-van-phong-pham'], function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('index');
        Route::post('/save', [RegistrationController::class, 'save'])->name('save');
    });

    Route::group(['as' => 'history.', 'prefix' => 'lich-su-dang-ky'], function () {
        Route::get('/dot-dang-ky/{id_period?}', [RegistrationController::class, 'history'])->name('index');
    });

    Route::group(['as' => 'buy_note.', 'prefix' => 'phieu-mua', 'middleware' => 'acl:buy_note-manage'], function () {
        Route::get('/', [BuyNoteController::class, 'index'])->name('index');
        Route::get('/create/{id_period}', [BuyNoteController::class, 'create'])->name('create');
        Route::get('/dot-dang-ky', [BuyNoteController::class, 'list_period'])->name('list_period');
        Route::post('/create/{id_period}', [BuyNoteController::class, 'store'])->name('store');
        Route::get('/detail/{id?}', [BuyNoteController::class, 'detail'])->name('detail');
        Route::get('/search', [BuyNoteController::class, 'search'])->name('search');
    });

    Route::group(['as' => 'fix_note.', 'prefix' => 'phieu-sua'], function () {
        Route::get('/', [FixNoteController::class, 'index'])->name('index');
        Route::get('/create', [FixNoteController::class, 'create'])->name('create');
        Route::post('/create', [FixNoteController::class, 'store'])->name('store');
        Route::get('/detail/{id?}', [FixNoteController::class, 'detail'])->name('detail');
        Route::get('/edit/{id?}', [FixNoteController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [FixNoteController::class, 'update'])->name('update');
        Route::get('/search', [FixNoteController::class, 'search'])->name('search');
        Route::delete('/delete/{id?}', [FixNoteController::class, 'delete'])->name('delete');
    });

    Route::group(['as' => 'process_note.', 'prefix' => 'xu-ly', 'middleware' => 'acl:request_note-process'], function () {
        Route::get('/', [ProcessNoteController::class, 'index'])->name('index');
        Route::get('/detail/{id?}', [ProcessNoteController::class, 'detail'])->name('detail');
        Route::post('/confirm/{id?}', [ProcessNoteController::class, 'confirm'])->name('confirm');
        Route::post('/reject/{id?}', [ProcessNoteController::class, 'reject'])->name('reject');
        Route::post('/update-sua/{id?}', [ProcessNoteController::class, 'update_detail_fix'])->name('update_detail_fix');
    });
});
