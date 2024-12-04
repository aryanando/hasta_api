<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $dokter = DB::connection('simsvbaru')->select("SELECT jad.kd_dokter,dok.nm_dokter,jad.hari_kerja,jad.jam_mulai,jad.jam_selesai,jad.kuota, poli.nm_poli FROM jadwal AS jad INNER JOIN dokter AS dok ON dok.kd_dokter = jad.kd_dokter INNER JOIN poliklinik AS poli ON poli.kd_poli = jad.kd_poli");
        $dokter = Dokter::with('jadwalPoli.poliKlinik')->get();
        // $dokter = JadwalDokter::all();
        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $dokter,
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
    public function show(Request $request)
    {
        $input = $request->all();
        $dokter = Dokter::with('jadwalPoli.poliKlinik')
        ->where('kd_dokter', '=', $input['kd_dokter'])
        ->get()->first();
        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $dokter,
        ], 200);
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
