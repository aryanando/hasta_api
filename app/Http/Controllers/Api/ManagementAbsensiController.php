<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\API\BaseController;

use App\Models\Absens;
use App\Models\Shifts;
use App\Models\User_shifts;
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
        $dataAbsensi = new Absens();

        $data = array();
        $data['absensi_hari_ini'] = User_shifts::where(DB::raw('CAST(user_shifts.check_in AS DATE)'), '=', DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"))
            ->with('users')
            ->with('shifts')
            ->orderBy('user_shifts.updated_at', 'desc')
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
