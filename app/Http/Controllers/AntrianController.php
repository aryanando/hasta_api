<?php

namespace App\Http\Controllers;

use App\Models\simrs\AntriPoli;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function antrianPoli(Request $request) {
        $input = $request->all();

        $result = AntriPoli::with(['dataDokter', 'dataRegPriksa.pasien'])->where('kd_dokter', '=', $input['kd_dokter'])->get()->first();
        $message = 'Get Data Successfully';
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $result,
        ], 200);
    }
}
