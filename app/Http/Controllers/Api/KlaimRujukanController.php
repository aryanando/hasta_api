<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KlaimRujukan;
use App\Models\RegistrasiPeriksa;
use App\Models\RujukMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KlaimRujukanController extends Controller
{
    //

    function index()
    {
        $data = KlaimRujukan::with(['petugasPendaftaran', 'petugasKasir', 'perujukBlu'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $data,
        ], 200);
    }

    function show($id)
    {
        $data = KlaimRujukan::where('id', '=', $id)->with(['petugasPendaftaran', 'petugasKasir', 'perujukBlu'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Get rujukan Sucessfull',
            'data' => $data[0],
        ], 200);
    }
    function getDataRujukan()
    {
        $data = RujukMasuk::with('registrasi.pasien')->orderBy('no_rawat', 'DESC')
            ->skip(0)->take(50)->get();

        return response()->json([
            'success' => true,
            'message' => 'Get rujukan Sucessfull',
            'data' => $data,
        ], 200);
    }

    function getGroupDataRujukan() {
        $data['data_non_karyawan'] = KlaimRujukan::select('nama_perujuk', DB::raw('count(*) as total'))
        ->groupBy('nama_perujuk')
        ->where('perujuk_id', '=', null)
        ->get();

        $data['data_karyawan'] = KlaimRujukan::select('perujuk_id', DB::raw('count(*) as total'))
        ->with(['perujukBlu'])
        ->groupBy('perujuk_id')
        ->where('perujuk_id', '!=', null)
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Get detail group rujukan Sucessfull',
            'data' => $data,
        ], 200);
    }

    function store(Request $request)
    {
        $input = $request->post();

        if ($input['perujuk_id'] == 'null') {
            unset($input['perujuk_id']);
        }
        $data = KlaimRujukan::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Create rujukan Sucessfull',
            'data' => $data,
        ], 200);
    }

    function update($id)
    {
        $rujukan = KlaimRujukan::find($id);
        $rujukan->petugas_kasir = Auth::id();
        $data = $rujukan->save();
        return response()->json([
            'success' => true,
            'message' => 'Data rujukan updated Sucessfull',
            'data' => $data,
        ], 200);
    }
}
