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
        $result = DataBarang::with(['dataRiwayatBarangMedisLast', 'dataRiwayatBarangMedis' => function ($query) {
            $query->whereDate('tanggal', Carbon::yesterday()->toString());
            $query->orWhereDate('tanggal', Carbon::today());
        }, 'dataGudangBarang' => function ($query) {
            $query->where('kd_bangsal', '=', 'G001');
            $query->orWhere('kd_bangsal', '=', 'B0153');
            $query->orWhere('kd_bangsal', '=', 'B0152');
        }])->where('status', '=', '1')
        // ->where('kode_brng', '=', '1010401001501005')
        ->get();

        $count2 = 0;
        $count = 0;

        foreach ($result as $data) {
            if ( count($data['dataRiwayatBarangMedis']) == 0 ) {
                $count++;
            }else{
                $count2++;
            }
        }
        $message = 'Get Data Successfully';
        return response()->json([
            'jumlah_tidak_terpakai' => $count,
            'jumlah_terpakai' => $count2,
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
