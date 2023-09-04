<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/register', function(){
    return view('auth.register');
});

Route::get('/login',[LoginController::class,'show'])->name('login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::post('/simpan-pendaftaran',[RegisterController::class,'store'])->name('simpan.pendaftaran');
Route::get('/verifikasi-akun',[OtpController::class,'view'])->name('otp.show');
Route::post('/verifikasi-otp',[OtpController::class,'verifyOtp'])->name('otp.verify');
Route::post('/proses-login',[LoginController::class,'prosesLogin'])->name('login.proses');
Route::get('/kirim-ulang-otp',[OtpController::class,'reSend'])->name('otp.kirim.ulang');


Route::prefix('admin')->middleware(['auth:user'])->group(function () {
    Route::group(['middleware' => ['cek_login:0']], function () {
        Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

        // Outlet
        Route::controller(App\Http\Controllers\Admin\OutletController::class)->group(function (){
            Route::get('/outlet','show')->name('admin.outlet.show');
            Route::get('/outlet/create','create')->name('admin.outlet.create');
            Route::post('/outlet','store')->name('admin.outlet.store');
            Route::get('/outlet/{id}/edit','edit')->name('admin.outlet.edit');
            Route::post('/outlet/{id}/update','update')->name('admin.outlet.update');
            Route::get('/outlet/{id}/destroy','destroy')->name('admin.outlet.destroy');
        });

        // Discount
        Route::controller(App\Http\Controllers\Admin\DiscountController::class)->group(function (){
            Route::get('/discount','show')->name('admin.discount.show');
            Route::get('/discount/create','create')->name('admin.discount.create');
            Route::post('/discount','store')->name('admin.discount.store');
            Route::get('/discount/{id}/edit','edit')->name('admin.discount.edit');
            Route::post('/discount/{id}/update','update')->name('admin.discount.update');
            Route::get('/discount/{id}/destroy','destroy')->name('admin.discount.destroy');
        });

        // Tipe Orderan
        Route::controller(App\Http\Controllers\Admin\JenisbarangController::class)->group(function (){
            Route::get('/jenis-barang','show')->name('admin.jenis.show');
            Route::get('/jenis-barang/create','create')->name('admin.jenis.create');
            Route::post('/jenis-barang','store')->name('admin.jenis.store');
            Route::get('/jenis-barang/{id}/edit','edit')->name('admin.jenis.edit');
            Route::post('/jenis-barang/{id}/update','update')->name('admin.jenis.update');
            Route::get('/jenis-barang/{id}/destroy','destroy')->name('admin.jenis.destroy');
        });
    });
});

Route::prefix('pelanggan')->middleware(['auth:user'])->group(function () {
    Route::group(['middleware' => ['cek_login:1']], function () {
        Route::get('dashboard',[App\Http\Controllers\Pelanggan\DashboardController::class, 'index'])->name('pelanggan.dashboard');

        Route::controller(App\Http\Controllers\Pelanggan\OrderController::class)->group(function (){
            Route::get('/order','show')->name('pelanggan.order.show');
            Route::get('/order/create','create')->name('pelanggan.order.create');
            Route::post('/order/create/','createTrackno')->name('pelanggan.order.createTrackno');
            Route::get('/order/{trackingNo}','viewTrack')->name('pelanggan.order.trackno');
        });

    });
});


