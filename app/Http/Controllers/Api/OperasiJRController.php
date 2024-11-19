<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\simrs\Operasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OperasiJRController extends Controller
{
    public function index()
    {
        $result = Operasi::whereMonth('tgl_operasi', Carbon::now())->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data operasi successfully.',
            'data' => $result,
        ], 200);
    }

    public function getByNoRM($no_rkm_medis)
    {
        $result = Pasien::with(['regPeriksa'  => function ($query) {
            return $query->has('dataOperasi')->with('dataOperasi');
        }])->where('no_rkm_medis', '=', $no_rkm_medis)->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data operasi successfully.',
            'data' => $result,
        ], 200);
    }
}
