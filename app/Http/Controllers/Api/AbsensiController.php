<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\Shifts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()) {
            $user = Auth::user();
            $dataAbsensi = new Shifts();

            $data = array();


            $data['shift_hari_ini'] = $dataAbsensi->select('*')
            ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
            ->where('user_shifts.user_id', '=', $user['id'])
            ->where(DB::raw("CAST('".Carbon::today()->toDateString()."' AS DATE)"), '>=', DB::raw('CAST(user_shifts.valid_date_start AS DATE)'))
            ->where(DB::raw("CAST('".Carbon::today()->toDateString()."' AS DATE)"), '<=', DB::raw('CAST(user_shifts.valid_date_end AS DATE)'))
            ->get();

            $data['absensi_hari_ini'] = $dataAbsensi->select('*')
            ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
            ->join('absens', 'absens.shift_id', '=', 'shifts.id')
            ->where('user_shifts.user_id', '=', $user['id'])
            ->where(DB::raw("CAST('".Carbon::today()->toDateString()."' AS DATE)"), '>=', DB::raw('CAST(user_shifts.valid_date_start AS DATE)'))
            ->where(DB::raw("CAST('".Carbon::today()->toDateString()."' AS DATE)"), '<=', DB::raw('CAST(user_shifts.valid_date_end AS DATE)'))
            ->get();

            return response()->json([
                'success' => true,
                'message' => 'Login successfully',
                'data' => $data,
            ], 200);
        }
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
    public function show(Shifts $shifts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shifts $shifts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shifts $shifts)
    {
        //
    }
}
