<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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
    Route::post('edit/{nisn}', [AdminController::class, 'edit_siswa']);

    // CRUD petugas
    Route::post('create/petugas', [AdminController::class, 'create_petugas']);
    Route::get('read/petugas', [AdminController::class, 'read_petugas']);

    // CRUD kelas
    Route::post('create/kelas', [AdminController::class, 'create_kelas']);
    Route::get('read/kelas', [AdminController::class, 'read_kelas']);

    // CRUD spp
    Route::post('create/spp', [AdminController::class, 'create_spp']);
    Route::get('read/spp', [AdminController::class, 'read_spp']);
});