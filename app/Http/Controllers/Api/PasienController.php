<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\RegistrasiPeriksa;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(string $name) {
        $result = [];
        $message = 'Name string minimal 3 huruf';
        if(strlen($name) >= 3){
            $result = Pasien::where('nm_pasien', 'LIKE', "%{$name}%")->get();
            if (count($result)>0) {
                $message = 'Get data pasien successfully.';
            } else {
                $message = 'Get data pasien unsuccessfully.';
            }
        }
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $result,
        ], 200);
    }

    public function regPeriksa($no_rkm_medis) {
        $result = Pasien::with(['regPeriksa'])->where('no_rkm_medis', '=', $no_rkm_medis)->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data pasien dan Regperiksa successfully.',
            'data' => $result,
        ], 200);
    }

    public function noRawat(Request $input) {

        $result = RegistrasiPeriksa::with('pasien')->where('no_rawat', '=', $input['no_rawat'])->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data pasien by no_rawat successfully.',
            'data' => $result,
        ], 200);
    }

    public function noRkmMedis($no_rkm_medis) {

        $result = Pasien::where('no_rkm_medis', '=', $no_rkm_medis)->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data pasien by no_rkm_medis successfully.',
            'data' => $result,
        ], 200);
    }
}
