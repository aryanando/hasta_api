<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use App\Models\simrs\RiwayatBarangMedis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanFarmasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $result = RiwayatBarangMedis::whereDate('tanggal', Carbon::today())->get();
        $result = DataBarang::with(['dataRiwayatBarangMedis' => function ($query) {
            $query->whereDate('tanggal', Carbon::today());
            $query->orWhereDate('tanggal', Carbon::yesterday());
        }])->get();
        $message = 'Get Data Successfully';
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $result,
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
