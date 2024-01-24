<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengawasanController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrintController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [AuthController::class, 'autoLogout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


// Routes that require authentication
Route::middleware(['auth'])->group(function () {    
    Route::post('/add-user',                        [AuthController::class, 'addUser'])->name('add.user');
    Route::get('/delete-user/{id}',                 [AuthController::class, 'deleteUser'])->name('delete.user');       
    Route::post('/edit-user',                       [AuthController::class, 'editUser'])->name('edit.user');
    Route::get('pengawasan/{triwulan?}/{year?}',    [PengawasanController::class, 'index'])->name('index.page');
    Route::post('/tambah-pengawasan',               [PengawasanController::class, 'tambahPengawasan'])->name('tambah.pengawasan');
    Route::post('/pengawasan',                      [PengawasanController::class, 'lihatdata'])->name('lihat.data');
    Route::post('/tindak',                          [PengawasanController::class, 'tindaklanjut'])->name('tindak.lanjut');
    Route::post('/edit-pengawasan',                 [PengawasanController::class, 'editPengawasan'])->name('edit.pengawasan');
    Route::get('/delete-was/{id}',                  [PengawasanController::class, 'deletewas'])->name('delete.was');   
    Route::get('config',                            [ConfigController::class, 'instansi'])->name('config.instansi');
    Route::get('config/wasbid',                     [ConfigController::class, 'wasbid'])->name('config.wasbid');
    Route::post('/instansi/update',                 [ConfigController::class, 'update'])->name('instansi.update');
    Route::post('/tambah-bidang',                   [ConfigController::class, 'tambahBidang'])->name('tambah.bidang');
    Route::get('/hapus-bidang/{id}',                [ConfigController::class, 'hapusBidang'])->name('hapus.bidang');
    Route::post('/edit-bidang',                     [ConfigController::class, 'editBidang'])->name('edit.bidang');
    Route::post('/update-logo',                     [ConfigController::class, 'updateLogo'])->name('update.logo');
    Route::post('/update-kopsurat',                 [ConfigController::class, 'updateKopSurat'])->name('update.kopsurat');
    Route::get('/print-temuan/{id}',                [PrintController::class, 'printTemuan'])->name('print.temuan');
    Route::get('/print-tindaklanjut/{id}',          [PrintController::class, 'printTindaklanjut'])->name('print.tindaklanjut');
    Route::post('/filter-report',                   [PrintController::class, 'filterReport'])->name('filter.report');

});
