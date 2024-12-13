<?php

namespace App\Http\Controllers;

use App\Models\RegistrasiPeriksa;
use App\Models\simrs\AntriPoli;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function antrianPoli(Request $request)
    {
        $input = $request->all();

        $result = AntriPoli::with(['dataDokter', 'dataRegPriksa.pasien'])->where('kd_dokter', '=', $input['kd_dokter'])->get()->first();
        $result2 = RegistrasiPeriksa::with(['pasien'])
            ->where('kd_dokter', '=', $input['kd_dokter'])
            ->where('stts', '=', 'Belum')
            ->where('kd_poli', '=', $input['kd_poli'])
            ->whereDate('tgl_registrasi', Carbon::today())
            ->limit(3)
            ->get();
            $result3 = RegistrasiPeriksa::with(['pasien'])
            ->where('kd_dokter', '=', $input['kd_dokter'])
            ->where('stts', '=', 'Belum')
            ->where('kd_poli', '=', $input['kd_poli'])
            ->whereDate('tgl_registrasi', Carbon::today())
            ->get();
        $message = 'Get Data Successfully';
        AntriPoli::where('kd_dokter', '=', $input['kd_dokter'])->delete();
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'panggil' => $result,
                'antrian'   => $result2,
                'jumlahAntrianLengkap' => count($result3)
            ]
        ], 200);
    }
}
