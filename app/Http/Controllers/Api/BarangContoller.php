<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use Illuminate\Http\Request;

class BarangContoller extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = DataBarang::where('status', '=', '1')->with([
            'dataRiwayatMedis' => function ($q) {
                $q->whereMonth('riwayat_barang_medis.tanggal', '=', '08')
                    ->whereYear('riwayat_barang_medis.tanggal', '=', '2024');
            }
        ])->get();
        // $dokter = JadwalDokter::all();
        return response()->json([
            'success' => true,
            'message' => 'Get Data Obat Sucessfull',
            'data' => $barang,
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
