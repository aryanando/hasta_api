<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KlaimRujukan;
use App\Models\RegistrasiPeriksa;
use App\Models\RujukMasuk;
use Illuminate\Http\Request;

class KlaimRujukanController extends Controller
{
    //

    function index() {
        $data = KlaimRujukan::with(['petugasPendaftaran', 'petugasKasir','perujukBlu'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $data,
        ], 200);
    }

    function show($id) {
        $data = KlaimRujukan::where('id', '=', $id)->with(['petugasPendaftaran', 'petugasKasir','perujukBlu'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $data[0],
        ], 200);
    }
    function getDataRujukan() {
        $data = RujukMasuk::with('registrasi.pasien')->orderBy('no_rawat', 'DESC')
        ->skip(0)->take(50)->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $data,
        ], 200);
    }

    function store(Request $request) {
        $input = $request->post();
        $data = KlaimRujukan::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $data,
        ], 200);
    }


}
