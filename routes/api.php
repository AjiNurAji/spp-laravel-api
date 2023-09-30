<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route for authentication
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    // Auth admin or petugas
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);

    // Auth siswa
    Route::post('login-siswa', [SiswaController::class, 'login']);
    Route::post('logout-siswa', [SiswaController::class, 'logout']);
    Route::post('me-siswa', [SiswaController::class, 'me']);
});

// Route for CRUD
Route::group([
    'middleware' => 'api'
], function () {
    // CRUD siswa
    Route::post('create/siswa', [AdminController::class, 'create_siswa']);
    Route::get('read/siswa', [AdminController::class, 'read_siswa']);
    Route::post('edit/siswa/{nisn}', [AdminController::class, 'edit_siswa']);
    Route::delete('delete/siswa/{nisn}', [AdminController::class, 'delete_siswa']);

    // CRUD petugas
    Route::post('create/petugas', [AdminController::class, 'create_petugas']);
    Route::get('read/petugas', [AdminController::class, 'read_petugas']);
    Route::post('edit/petugas/{id}', [AdminController::class, 'edit_petugas']);
    Route::delete('edit/petugas/{id}', [AdminController::class, 'delete_petugas']);
    
    // CRUD kelas
    Route::post('create/kelas', [AdminController::class, 'create_kelas']);
    Route::get('read/kelas', [AdminController::class, 'read_kelas']);
    Route::post('edit/kelas/{id}', [AdminController::class, 'edit_petugas']);
    Route::delete('edit/kelas/{id}', [AdminController::class, 'delete_petugas']);
    
    // CRUD spp
    Route::post('create/spp', [AdminController::class, 'create_spp']);
    Route::get('read/spp', [AdminController::class, 'read_spp']);
    Route::post('edit/spp/{id}', [AdminController::class, 'edit_spp']);
    Route::delete('edit/spp/{id}', [AdminController::class, 'delete_spp']);

    // transaksi
    Route::post('pay', [PayController::class, 'create']);
    Route::get('show-all-transaksi', [Pembayaran::class, 'showAll']);
});