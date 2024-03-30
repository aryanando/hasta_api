<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\API\BaseController;
use App\Models\Shifts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagementAbsensiController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $dataAbsensi = new Shifts();

        $data = array();
        $data['absensi_hari_ini'] = $dataAbsensi->select('absens.id as absen_id', 'absens.check_in as absen_check_in', 'absens.check_out as absen_check_out', 'shifts.check_in as shift_check_in', 'shifts.check_out as shift_check_out', 'shifts.next_day', 'users.id as user_id', 'users.name as user_name')
            ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
            ->join('absens', 'absens.shift_id', '=', 'shifts.id')
            ->join('users', 'users.id', '=', 'absens.user_id')
            ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '=', DB::raw('CAST(absens.created_at AS DATE)'))
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Absensi Sucessfull',
            'data' => $data,
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
