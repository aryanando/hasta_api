<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poliklinik;
use App\Models\RegistrasiPeriksa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanRajalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $from = date('2024-11-06');
        $to = date('2024-11-07');
        $data =
            RegistrasiPeriksa::with(['pasien','dataPoli', 'dataDokter', 'dataPenjab', 'dataResepObat.dataResepDokter.dataBarang', 'dataPeriksaRadiologi', 'dataPeriksaLaboratorium.dataDetailPeriksaLab.dataTemplateLaboratorium'])
            // RegistrasiPeriksa::with(['dataPeriksaLaboratorium.dataDetailPeriksaLab.dataTemplateLaboratorium'])
            ->whereDate('tgl_registrasi', Carbon::today())
            // ->whereBetween('tgl_registrasi', [$from, $to])
            ->get();
        // $dokter = JadwalDokter::all();
        $data2 = [];

        // foreach ($data as $rad) {
        //     if (!empty($rad['data_periksa_radiologi'])) {
        //         $data2 = $rad;
        //     }
        // }
        return response()->json([
            'success' => true,
            'message' => 'Get Laporan Rajal Sucessfull',
            'data' => $data,
        ], 200);
    }

    public function tanggal($tahun, $bulan, $tanggal)
    {
        $date = date($tahun.'-'.$bulan.'-'.$tanggal);
        $data =
            RegistrasiPeriksa::with(['pasien','dataPoli', 'dataDokter', 'dataPenjab', 'dataResepObat.dataResepDokter.dataBarang', 'dataPeriksaRadiologi', 'dataPeriksaLaboratorium.dataDetailPeriksaLab.dataTemplateLaboratorium'])
            // RegistrasiPeriksa::with(['dataPeriksaLaboratorium.dataDetailPeriksaLab.dataTemplateLaboratorium'])
            ->whereDate('tgl_registrasi', $date)
            // ->whereBetween('tgl_registrasi', [$from, $to])
            ->get();
        // $dokter = JadwalDokter::all();
        $data2 = [];

        // foreach ($data as $rad) {
        //     if (!empty($rad['data_periksa_radiologi'])) {
        //         $data2 = $rad;
        //     }
        // }
        return response()->json([
            'success' => true,
            'message' => 'Get Laporan Rajal pada tanggal '.$date.' Sucessfull',
            'data' => $data,
        ], 200);
    }

    public function dokter($tahun, $bulan, $tanggal, $kd_dokter)
    {
        $date = date($tahun.'-'.$bulan.'-'.$tanggal);
        $data =
            RegistrasiPeriksa::with(['pasien','dataPoli', 'dataDokter', 'dataPenjab', 'dataResepObat.dataResepDokter.dataBarang', 'dataPeriksaRadiologi', 'dataPeriksaLaboratorium.dataDetailPeriksaLab.dataTemplateLaboratorium'])
            // RegistrasiPeriksa::with(['dataPeriksaLaboratorium.dataDetailPeriksaLab.dataTemplateLaboratorium'])
            ->whereDate('tgl_registrasi', $date)
            ->where('kd_dokter', '=', $kd_dokter)
            // ->whereBetween('tgl_registrasi', [$from, $to])
            ->get();
        // $dokter = JadwalDokter::all();
        $data2 = [];

        // foreach ($data as $rad) {
        //     if (!empty($rad['data_periksa_radiologi'])) {
        //         $data2 = $rad;
        //     }
        // }
        return response()->json([
            'success' => true,
            'message' => 'Get Laporan Rajal pada tanggal '.$date.' Sucessfull',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
