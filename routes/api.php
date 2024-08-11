<?php

use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\AbsensiTokenController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\DokterController;
use App\Http\Controllers\Api\KeuanganController;
use App\Http\Controllers\Api\KlaimRujukanController;
use App\Http\Controllers\Api\ManagementAbsensiController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\RanapController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserShiftController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {

    // Login Data
    Route::post('login', [AuthenticationController::class, 'store']);
    Route::post('register', [RegisterController::class, 'store']);
    Route::post('logout', [AuthenticationController::class, 'destroy'])->middleware('auth:api');
    Route::get('me', [AuthenticationController::class, 'show'])->middleware('auth:api');

    // Ranap
    Route::get('ranap', [RanapController::class, 'index'] )->middleware('auth:api');

    // Absensi
    Route::get('absensi', [AbsensiController::class, 'index'] )->middleware('auth:api');
    Route::get('absensi/{month}', [AbsensiController::class, 'index'] )->middleware('auth:api');
    Route::post('absensi', [AbsensiController::class, 'store'] )->middleware('auth:api');
    Route::post('absensi/{token}', [AbsensiController::class, 'store'] )->middleware('auth:api');
    Route::put('absensi', [AbsensiController::class, 'update'] )->middleware('auth:api');
    Route::put('absensi/{token}/{check}', [AbsensiController::class, 'update'] )->middleware('auth:api');

    // Absensi Token
    Route::get('absensi-token', [AbsensiTokenController::class, 'index'] )->middleware('auth:api');
    Route::post('absensi-token', [AbsensiTokenController::class, 'store'] )->middleware('auth:api');

    // Absensi Management
    Route::get('absensi-karyawan', [ManagementAbsensiController::class, 'index'] )->middleware('auth:api');

    // Karyawan
    Route::get('karyawan', [KaryawanController::class, 'index'] )->middleware('auth:api');

    // Shift
    Route::get('shift', [ShiftController::class, 'index'] )->middleware('auth:api');
    Route::post('shift', [ShiftController::class, 'store'] )->middleware('auth:api');

    // User Shift
    Route::get('shift-user/{unitOrMonth}/{month}', [UserShiftController::class, 'index'] )->middleware('auth:api'); // Unit
    Route::get('shift-user/{unitOrMonth}', [UserShiftController::class, 'index'] )->middleware('auth:api'); // Unit
    Route::post('shift-user', [UserShiftController::class, 'store'] )->middleware('auth:api'); // Per User
    Route::delete('shift-user', [UserShiftController::class, 'destroy'] )->middleware('auth:api'); // Per User

    // Unit
    Route::get('unit', [UnitController::class, 'index'] )->middleware('auth:api');
    Route::get('unit/{id}', [UnitController::class, 'show'] )->middleware('auth:api');
    Route::post('unit', [UnitController::class, 'store'] )->middleware('auth:api');

    // Slip
    Route::post('slip', [KeuanganController::class, 'store'] )->middleware('auth:api');
    Route::get('slip/{id}', [KeuanganController::class, 'show'] )->middleware('auth:api');

    // Pengumuman
    Route::get('pengumuman', [PengumumanController::class, 'index'] )->middleware('auth:api');

    // Dokter
    Route::get('dokter', [DokterController::class, 'index'] )->middleware('auth:api');

    // Klaim Rujukan
    Route::get('rujukan', [KlaimRujukanController::class, 'index'] )->middleware('auth:api');
    Route::get('rujukan/{id}', [KlaimRujukanController::class, 'show'] )->middleware('auth:api');
    Route::post('rujukan', [KlaimRujukanController::class, 'store'] )->middleware('auth:api');
    Route::get('rujukan-data', [KlaimRujukanController::class, 'getDataRujukan'] )->middleware('auth:api');
});



// Route::middleware('auth:api')->group( function () {
//     Route::resource('products', ProductController::class);
// });
