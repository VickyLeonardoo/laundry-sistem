<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Pelanggan\OrderController;
use App\Http\Controllers\Admin\JenisbarangController;
use App\Http\Controllers\Admin\OrderProsesController;
use App\Http\Controllers\Admin\OrderSelesaiController;
use App\Http\Controllers\Admin\OrderMenungguController;
use App\Http\Controllers\Pelanggan\PromoController;

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

Route::get('/',[LoginController::class,'show']);
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
        Route::controller(OutletController::class)->group(function (){
            Route::get('/outlet','show')->name('admin.outlet.show');
            Route::get('/outlet/create','create')->name('admin.outlet.create');
            Route::post('/outlet','store')->name('admin.outlet.store');
            Route::get('/outlet/{id}/edit','edit')->name('admin.outlet.edit');
            Route::post('/outlet/{id}/update','update')->name('admin.outlet.update');
            Route::get('/outlet/{id}/destroy','destroy')->name('admin.outlet.destroy');
        });

        // Discount
        Route::controller(DiscountController::class)->group(function (){
            Route::get('/discount','show')->name('admin.discount.show');
            Route::get('/discount/create','create')->name('admin.discount.create');
            Route::post('/discount','store')->name('admin.discount.store');
            Route::get('/discount/{id}/edit','edit')->name('admin.discount.edit');
            Route::post('/discount/{id}/update','update')->name('admin.discount.update');
            Route::get('/discount/{id}/destroy','destroy')->name('admin.discount.destroy');
        });

        // Tipe Orderan
        Route::controller(JenisbarangController::class)->group(function (){
            Route::get('/jenis-barang','show')->name('admin.jenis.show');
            Route::get('/jenis-barang/create','create')->name('admin.jenis.create');
            Route::post('/jenis-barang','store')->name('admin.jenis.store');
            Route::get('/jenis-barang/{id}/edit','edit')->name('admin.jenis.edit');
            Route::post('/jenis-barang/{id}/update','update')->name('admin.jenis.update');
            Route::get('/jenis-barang/{id}/destroy','destroy')->name('admin.jenis.destroy');
        });

        // Order Menunggu Controller
        Route::controller(OrderMenungguController::class)->group(function (){
            Route::get('/order/menunggu','show')->name('admin.order.menunggu.show');
            Route::get('/order/menunggu/{transactionNo}/edit' ,'edit')->name('admin.order.menunggu.transaction.edit');
            Route::post('/order/menunggu/{transactionNo}/proses' ,'proses')->name('admin.order.menunggu.transaction.proses');
            Route::get('/order/menunggu/{transactionNo}/create/order-item' ,'createOrderItem')->name('admin.order.menunggu.transaction.create');
            Route::post('/order/menunggu/{id}/create/order-item' ,'storeOrderItem')->name('admin.order.menunggu.transaction.store');
        });

        Route::controller(OrderProsesController::class)->group(function (){
            Route::get('/order/diproses','show')->name('admin.order.diproses.show');
            Route::get('/order/diproses/{transactionNo}/edit' ,'edit')->name('admin.order.diproses.transaction.edit');
            Route::post('/order/diproses/{id}/selesai' ,'selesai')->name('admin.order.diproses.selesai.order');
            Route::post('/order/diproses/{id}/pembayaranSelesai' ,'pembayaranSelesai')->name('admin.order.diproses.selesai.pembayaran');
        });

        Route::controller(OrderSelesaiController::class)->group(function (){
            Route::get('/order/selesai', 'show')->name('admin.order.selesai.show');
            Route::get('/order/selesai/{transactionNo}/edit' ,'edit')->name('admin.order.selesai.transaction.edit');
            Route::post('/orderan/selesai/{id}/diterima', 'orderanDiterima')->name('admin.order.selesai.diterima');
        });

    });
});

Route::prefix('pelanggan')->middleware(['auth:user'])->group(function () {
    Route::group(['middleware' => ['cek_login:1']], function () {
        Route::get('dashboard',[App\Http\Controllers\Pelanggan\DashboardController::class, 'index'])->name('pelanggan.dashboard');

        //Order
        Route::controller(OrderController::class)->group(function (){
            Route::get('/order','show')->name('pelanggan.order.show');
            Route::get('/order/create','create')->name('pelanggan.order.create');
            Route::post('/order/create/','createTrackno')->name('pelanggan.order.createTrackno');
            Route::get('/order/{transactionNo}','viewTrack')->name('pelanggan.order.trackno');
            Route::post('/order/{id}/metode-pembayaran','updateMetode')->name('pelanggan.order.metode');
        });

        //Promo
        Route::controller(PromoController::class)->group(function (){
            Route::get('/promo','show')->name('pelanggan.promo.show');
        });


    });
});


