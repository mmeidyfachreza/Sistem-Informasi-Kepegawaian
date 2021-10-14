<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\GolonganController;
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
    return view('admin.print_all_presence');
});

Route::get('tes2', [PresensiController::class,'allEmployee']);
Route::get('tes3', [PresensiController::class,'allEmployeeFilter'])->name('presence.filter');

Auth::routes();

Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
//Admin Home page after login
Route::group(['middleware'=>'admin'], function() {
    Route::get('/admin/home', [HomeController::class,'index'])->name('admin.home');
    Route::post('/admin/cari-pegawai', [HomeController::class,'searchEmployee'])->name('dashboard.search');
    Route::resource('pegawai', PegawaiController::class);
    Route::post('/pegawai/cari', [PegawaiController::class,'search'])->name('search.employee');
    Route::resource('jabatan', JabatanController::class);
    Route::resource('golongan', GolonganController::class);
    Route::get('/admin/pegawai/presensi/{id}', [HomeController::class,'employeePresence'])->name('presensi.pegawai');
    Route::get('/admin/pegawai/presensi-cetak', [HomeController::class,'printPresence'])->name('cetak.presensi');
    Route::get('/admin/presensi-pegawai', [PresensiController::class,'allEmployee'])->name('presensi.keseluruhan');
    Route::get('/admin/presensi-pegawai/filter', [PresensiController::class,'allEmployeeFilter'])->name('presence.all.filter');
    Route::get('/admin/presensi-pegawai/print', [PresensiController::class,'allEmployeePrint'])->name('presence.all.print');
    Route::get('/admin/presensi-pegawai/izin/{id}', [PresensiController::class,'employeePermit'])->name('presence.record.permit');
    Route::get('/admin/presensi-pegawai/sakit/{id}', [PresensiController::class,'employeeSick'])->name('presence.record.sick');
    Route::get('/admin/presensi-pegawai/alpa/{id}', [PresensiController::class,'employeeAlpa'])->name('presence.record.alpa');
});

Route::group(['middleware'=>'auth'], function() {
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('/profil', [HomeController::class,'profile'])->name('profile');
    Route::resource('presensi', PresensiController::class);
    Route::get('/catat-kehadiran', [PresensiController::class,'store'])->name('catat.kehadiran');
    Route::get('/catat-izin', [PresensiController::class,'permit'])->name('permit');
});
