<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\Absens;
use App\Models\Shifts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            ->where(DB::raw("CAST('".Carbon::today()->toDateString()."' AS DATE)"), '=', DB::raw('CAST(absens.created_at AS DATE)'))
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
    public function store(Request $request): JsonResponse
    {
        //


        $validator = Validator::make($request->all(), [
            'shift_id' => 'required|exists:shifts,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();

        $flag = Absens::select('*')
        ->where('user_id', '=', $input['user_id'])
        ->where('shift_id', '=', $input['shift_id'])
        ->where(DB::raw("CAST('".Carbon::today()->toDateString()."' AS DATE)"), '=', DB::raw('CAST(absens.created_at AS DATE)'))
        ->count();

        if ($flag > 0) {
            return $this->sendResponse([],'User Already Initiate Absens');
        }
        $user = Absens::create($input);
        return $this->sendResponse([$user],'User check-in successfully.');
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
