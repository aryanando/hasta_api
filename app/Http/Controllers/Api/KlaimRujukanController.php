<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiPeriksa;
use App\Models\RujukMasuk;
use Illuminate\Http\Request;

class KlaimRujukanController extends Controller
{
    //

    function index() {
        $data = RujukMasuk::with('registrasi')->orderBy('no_rawat', 'DESC')
        ->skip(0)->take(50)->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $data,
        ], 200);
    }
}
