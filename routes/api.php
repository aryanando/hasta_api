<?php

use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\AbsensiTokenController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\BarangContoller;
use App\Http\Controllers\Api\DokterController;
use App\Http\Controllers\Api\ESurveyController;
use App\Http\Controllers\Api\JenisKaryawanController;
use App\Http\Controllers\Api\KeuanganController;
use App\Http\Controllers\Api\KlaimRujukanController;
use App\Http\Controllers\Api\LaporanRajalController;
use App\Http\Controllers\Api\ManagementAbsensiController;
use App\Http\Controllers\Api\OperasiJRController;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\RanapController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserShiftController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\UserStatisticController;
use App\Models\JenisKaryawan;
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
    Route::delete('shift/{id}', [ShiftController::class, 'delete'] )->middleware('auth:api');

    // User Shift
    Route::get('shift-user/{unitOrMonth}/{month}', [UserShiftController::class, 'index'] )->middleware('auth:api'); // Unit
    Route::get('shift-user/{unitOrMonth}', [UserShiftController::class, 'index'] )->middleware('auth:api'); // Unit
    Route::post('shift-user', [UserShiftController::class, 'store'] )->middleware('auth:api'); // Per User
    Route::delete('shift-user', [UserShiftController::class, 'destroy'] )->middleware('auth:api'); // Per User

    // Unit
    Route::get('unit', [UnitController::class, 'index'] )->middleware('auth:api');
    Route::get('unit/{id}', [UnitController::class, 'show'] )->middleware('auth:api');
    Route::post('unit', [UnitController::class, 'store'] )->middleware('auth:api');

    // Unit
    Route::get('jenis-karyawan', [JenisKaryawanController::class, 'index'] )->middleware('auth:api');
    Route::get('jenis-karyawan/{id}', [JenisKaryawanController::class, 'show'] )->middleware('auth:api');

    // Slip
    Route::post('slip', [KeuanganController::class, 'store'] )->middleware('auth:api');
    Route::get('slip/{id}', [KeuanganController::class, 'show'] )->middleware('auth:api');
    Route::get('slips', [KeuanganController::class, 'index'] )->middleware('auth:api');
    Route::get('slips/activate', [KeuanganController::class, 'update'] )->middleware('auth:api');
    Route::get('slips/{id}', [KeuanganController::class, 'index'] )->middleware('auth:api');
    Route::get('slips/{id}/{bulan}/{tahun}', [KeuanganController::class, 'index'] )->middleware('auth:api');
    Route::get('slips-perbualan/{bulan}/{tahun}', [KeuanganController::class, 'bulan'] )->middleware('auth:api');


    // Pengumuman
    Route::get('pengumuman', [PengumumanController::class, 'index'] )->middleware('auth:api');

    // Dokter
    Route::get('dokter', [DokterController::class, 'index'] )->middleware('auth:api');

    // Klaim Rujukan
    Route::get('rujukan', [KlaimRujukanController::class, 'index'] )->middleware('auth:api');
    Route::get('rujukan/{id}', [KlaimRujukanController::class, 'show'] )->middleware('auth:api');
    Route::post('rujukan', [KlaimRujukanController::class, 'store'] )->middleware('auth:api');
    Route::put('rujukan/{id}', [KlaimRujukanController::class, 'update'] )->middleware('auth:api');
    Route::get('rujukan-data', [KlaimRujukanController::class, 'getDataRujukan'] )->middleware('auth:api');
    Route::get('rujukan-detail', [KlaimRujukanController::class, 'getGroupDataRujukan'] )->middleware('auth:api');

    // User Statistic
    Route::get('user-statistic', [UserStatisticController::class, 'show'] )->middleware('auth:api');
    Route::get('user-statistic/{id}', [UserStatisticController::class, 'show'] )->middleware('auth:api');
    Route::get('statistic', [UserStatisticController::class, 'index'] )->middleware('auth:api');

    // Barang
    Route::get('barang', [BarangContoller::class, 'index'] );

    // Esurvey
    Route::get('esurvey', [ESurveyController::class, 'index'] )->middleware('auth:api');
    Route::get('esurvey/unit', [ESurveyController::class, 'getByParam'] )->middleware('auth:api');
    Route::get('esurvey/unit/{id}', [ESurveyController::class, 'getByParam'] )->middleware('auth:api');
    Route::get('esurvey/jenis-karyawan', [ESurveyController::class, 'getByJenisKaryawan'] )->middleware('auth:api');
    Route::get('esurvey/jenis-karyawan/{id}', [ESurveyController::class, 'getByJenisKaryawan'] )->middleware('auth:api');
    Route::post('esurvey', [ESurveyController::class, 'store'] )->middleware('auth:api');
    Route::delete('esurvey/{id}', [ESurveyController::class, 'destroy'] )->middleware('auth:api');

    // Admin
    Route::get('admin/users', [UserController::class, 'index'])->middleware('auth:api');
    Route::get('admin/users/{id}', [UserController::class, 'show'])->middleware('auth:api');

    // Laporan
    Route::get('laporan/rajal', [LaporanRajalController::class, 'index'])->middleware('auth:api');
    Route::get('laporan/rajal/bytanggal/{tahun}/{bulan}/{tanggal}', [LaporanRajalController::class, 'tanggal'])->middleware('auth:api');
    Route::get('laporan/rajal/bydokter/{tahun}/{bulan}/{tanggal}/{kd_dokter}', [LaporanRajalController::class, 'tanggal'])->middleware('auth:api');

    // Operasi Jasaraharja
    Route::get('operasi', [OperasiJRController::class, 'index'])->middleware('auth:api');
    Route::get('operasi/by-no-rekam-medis/{no_rkm_medis}', [OperasiJRController::class, 'getByNoRM'])->middleware('auth:api');

    // Pasien
    Route::get('pasien/nama/{name}', [PasienController::class, 'index'])->middleware('auth:api');
    Route::get('regperiksa/{no_rkm_medis}', [PasienController::class, 'regPeriksa'])->middleware('auth:api');
    Route::get('pasien/no-rawat', [PasienController::class, 'noRawat'])->middleware('auth:api');

});



// Route::middleware('auth:api')->group( function () {
//     Route::resource('products', ProductController::class);
// });
