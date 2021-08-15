<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/tes', function () {
    echo "ok";
});

Auth::routes();

Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
//Admin Home page after login
Route::group(['middleware'=>'admin'], function() {
    Route::get('/admin/home', [HomeController::class,'index'])->name('admin.home');
    Route::post('/admin/cari-pegawai', [HomeController::class,'searchEmployee'])->name('dashboard.search');
    Route::resource('pegawai', EmployeeController::class);
    Route::post('/pegawai/cari', [EmployeeController::class,'searchEmployee'])->name('search.employee');
    Route::resource('jabatan', JobTitleController::class);
    Route::resource('golongan', SectionController::class);
    Route::get('/admin/pegawai/presensi/{id}', [HomeController::class,'employeePresence'])->name('presensi.pegawai');
    Route::get('/admin/pegawai/presensi-cetak', [HomeController::class,'printPresence'])->name('cetak.presensi');
});

Route::group(['middleware'=>'auth'], function() {
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::resource('presensi', PresenceController::class);
});
