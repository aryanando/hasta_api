<?php

use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\AbsensiTokenController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ManagementAbsensiController;
use App\Http\Controllers\Api\RanapController;
use App\Http\Controllers\API\RegisterController;
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
    Route::post('absensi', [AbsensiController::class, 'store'] )->middleware('auth:api');
    Route::post('absensi/{token}', [AbsensiController::class, 'store'] )->middleware('auth:api');
    Route::put('absensi', [AbsensiController::class, 'update'] )->middleware('auth:api');
    Route::put('absensi/{token}', [AbsensiController::class, 'update'] )->middleware('auth:api');

    // Absensi Token
    Route::get('absensi-token', [AbsensiTokenController::class, 'index'] )->middleware('auth:api');
    Route::post('absensi-token', [AbsensiTokenController::class, 'store'] )->middleware('auth:api');

    // Absensi Management
    Route::get('absensi-karyawan', [ManagementAbsensiController::class, 'index'] )->middleware('auth:api');
});



// Route::middleware('auth:api')->group( function () {
//     Route::resource('products', ProductController::class);
// });
