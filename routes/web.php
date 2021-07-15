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
    Route::post('/admin/cari-siswa', [HomeController::class,'searchStudent'])->name('dashboard.search');
    Route::resource('pegawai', EmployeeController::class);
    Route::post('/pegawai/cari', [EmployeeController::class,'searchEmployee'])->name('search.employee');
    // Route::resource('akun-sekolah', UserController::class);
    Route::resource('jabatan', JobTitleController::class);
    Route::resource('golongan', SectionController::class);
    // Route::post('siswa-import', [StudentController::class,'studentImport'])->name('student.import');
    // Route::post('siswa-update-import', [StudentController::class,'studentUpdateImport'])->name('student.import.update');
    // Route::get('format-export-siswa', [StudentController::class,'studentExportFormat'])->name('student.format.export');
    // Route::get('/siswa-sd', [StudentController::class,'indexSd'])->name('student.sd');
    // Route::get('/siswa-smp', [StudentController::class,'indexSmp'])->name('student.smp');
    // Route::get('/admin/download-file/{type}/name/{name}', [HomeController::class,'downloadFile'])->name('admin.download');
    // Route::get('surat-keterangan/{id}', [StudentController::class,'statementLetter'])->name('statement_letter');
    // Route::get('format-surat-keterangan/{id}', [HomeController::class,'downloadLetter'])->name('statement_letter2');
});

Route::group(['middleware'=>'auth'], function() {
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::resource('presensi', PresenceController::class);
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
