<?php

use App\Http\Controllers\{
    ProcessNoteController,
    EquipmentController,
    HomeController,
    PeriodRegistrationController,
    BuyNoteController,
    FixNoteController,
    ForgotPasswordController,
    HandoverNoteController,
    HandoverRegistrationController,
    LimitDefaultController,
    LimitStationeryController,
    NotificationController,
    ProcessLimitController,
    ProfileController,
    RegistrationController,
    StationeryController,
    StatisticController,
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

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/quy-dinh', [HomeController::class, 'introduce'])->name('introduce');
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::group(['as' => 'forgot_password.', 'middleware' => 'guest', 'prefix' => 'recovery'], function () {
    Route::get('/recovery/submit_email', [ForgotPasswordController::class, 'showSubmitEmail'])->name('submit_email');
    Route::post('/recovery/submit_email', [ForgotPasswordController::class, 'submitEmail']);
    Route::get('/recovery/submit_email_code', [ForgotPasswordController::class, 'showSubmitCode'])->name('submit_code');
    Route::post('/recovery/submit_email_code', [ForgotPasswordController::class, 'submitCode']);
    Route::get('/recovery/reset_password', [ForgotPasswordController::class, 'showResetPassword'])->name('reset_password');
    Route::post('/recovery/reset_password', [ForgotPasswordController::class, 'resetPassword']);
    Route::post('/send_code', [ForgotPasswordController::class, 'sendCodeAgain'])->name('send_code');
    Route::get('/result', [ForgotPasswordController::class, 'showResult'])->name('result');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'home'])->name('index');
    Route::group(['as' => 'notification.', 'prefix' => 'notify'], function () {
        Route::get('/', [NotificationController::class, 'list'])->name('list');
        Route::get('/mark-read', [NotificationController::class, 'markAsRead'])->name('mark_read');
    });

    Route::group(['as' => 'limit.', 'prefix' => 'han-muc'], function () {
        Route::get('/', [LimitStationeryController::class, 'index'])->name('index');
    });

    Route::group(['as' => 'limit_default.', 'prefix' => 'han-muc-mac-dinh', 'middleware' => 'acl:limit-manage'], function () {
        Route::get('/', [LimitDefaultController::class, 'index'])->name('index');
        Route::get('/stationery', [LimitDefaultController::class, 'getListStationery'])->name('list_stationery');
        Route::put('/update', [LimitDefaultController::class, 'update'])->name('update');
    });

    Route::group(['as' => 'process_limit.', 'prefix' => 'xu-ly-han-muc', 'middleware' => 'acl:limit-process'], function () {
        Route::get('/', [ProcessLimitController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [ProcessLimitController::class, 'detail'])->name('detail');
        Route::post('/confirm/{id}', [ProcessLimitController::class, 'confirm'])->name('confirm');
        Route::post('/reject/{id}', [ProcessLimitController::class, 'reject'])->name('reject');
    });

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
        Route::post('xu-ly/{id}', [UserController::class, 'handle_account'])->name('handle');
        Route::post('update-hanmuc/{id_user}', [UserController::class, 'updateLimit'])->name('update_limit')
            ->middleware('acl:limit-manage');
    });

    Route::group(['as' => 'profile.', 'prefix' => 'trang-ca-nhan'], function () {
        Route::get('/info', [ProfileController::class, 'showInfo'])->name('info');
        Route::put('/info', [ProfileController::class, 'updateInfo'])->name('update_info');
        Route::get('/password', [ProfileController::class, 'showFormChangPassword'])->name('show_password');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('update_password');
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

    Route::group(['as' => 'process_note.', 'prefix' => 'phieu-de-nghi', 'middleware' => 'acl:request_note-process'], function () {
        Route::get('/', [ProcessNoteController::class, 'index'])->name('index');
        Route::get('/detail/{id?}', [ProcessNoteController::class, 'detail'])->name('detail');
        Route::post('/confirm/{id?}', [ProcessNoteController::class, 'confirm'])->name('confirm');
        Route::post('/reject/{id?}', [ProcessNoteController::class, 'reject'])->name('reject');
        Route::post('/update-sua/{id?}', [ProcessNoteController::class, 'update_detail_fix'])->name('update_detail_fix');
        Route::get('/print/{id?}', [ProcessNoteController::class, 'print'])->name('print');
    });

    Route::group(['as' => 'handover_note.', 'prefix' => 'phieu-ban-giao', 'middleware' => 'acl:handover_note-manage'], function () {
        Route::get('/', [HandoverNoteController::class, 'index'])->name('index');
        Route::get('/create/{id_request_note?}', [HandoverNoteController::class, 'create'])->name('create');
        Route::post('/create/{id_request_note?}', [HandoverNoteController::class, 'store'])->name('store');
        Route::get('/detail/{id?}', [HandoverNoteController::class, 'detail'])->name('detail');
        Route::get('/edit/{id?}', [HandoverNoteController::class, 'edit'])->name('edit');
        Route::put('/update/{id?}', [HandoverNoteController::class, 'update'])->name('update');
        Route::post('/confirm/{id?}', [HandoverNoteController::class, 'confirm'])->name('confirm');
        Route::get('/search', [HandoverNoteController::class, 'search'])->name('search');
        Route::delete('/delete/{id?}', [HandoverNoteController::class, 'delete'])->name('delete');
        Route::get('/print/{id}', [HandoverNoteController::class, 'print'])->name('print');
    });
    Route::get('phieu-ban-giao/api/detail/{id?}', [HandoverNoteController::class, 'detail_ajax'])->name('handover_note.detail_ajax');

    Route::group(['as' => 'handover_registration.', 'prefix' => 'ban-giao-dang-ky', 'middleware' => 'acl:registration-handover'], function () {
        Route::get('/', [HandoverRegistrationController::class, 'list_period'])->name('list_period');
        Route::get('/danh-sach/{id_period?}', [HandoverRegistrationController::class, 'list_user'])->name('list_user');
        Route::get('/detail', [HandoverRegistrationController::class, 'detail'])->name('detail');
        Route::post('/handover', [HandoverRegistrationController::class, 'handover'])->name('handover');
    });

    Route::group(['as' => 'statistic.', 'prefix' => 'thong-ke', 'middleware' => 'acl:statistic'], function () {
        Route::get('/', [StatisticController::class, 'index'])->name('index');
    });
});
