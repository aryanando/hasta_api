<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\API\BaseController;
use App\Models\Absens;
use App\Models\AbsenTokens;
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
    public function index($month = null)
    {
        //
        if (Auth::user()) {
            $user = Auth::user();
            $dataAbsensi = new Shifts();
            $data = array();
            if ($month != NULL) {
                $data['shift_bulan_ini'] = $dataAbsensi->select('*')
                    ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
                    ->where('user_shifts.user_id', '=', $user['id'])
                    ->where(DB::raw("month('2024-".$month."-1')"), '=', DB::raw('month(user_shifts.valid_date_start)'))
                    // ->where(DB::raw("month('" . Carbon::today()->toDateString() . "'"), '=', DB::raw('month(user_shifts.valid_date_end)'))
                    ->get();

                return response()->json([
                    'success' => true,
                    'message' => 'Get Absensi Sucessfull',
                    'data' => $data,
                ], 200);
            } else {
                $data['shift_hari_ini'] = $dataAbsensi->select(
                     'shifts.id', 'shifts.shift_name', 'shifts.check_in', 'shifts.check_out', 'shifts.color', 'shifts.next_day', 'shifts.unit_id', 'user_shifts.valid_date_start', 'user_shifts.valid_date_end', 'user_shifts.user_id', 'user_shifts.shift_id', 'user_shifts.update_shift_id', 'user_shifts.id as user_shifts_id'
                )
                ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
                ->where('user_shifts.user_id', '=', $user['id'])
                ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '>=', DB::raw('CAST(user_shifts.valid_date_start AS DATE)'))
                ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '<=', DB::raw('CAST(user_shifts.valid_date_end AS DATE)'))
                ->get();

                if (isset($data['shift_hari_ini'][0])) {
                    if ($data['shift_hari_ini'][0]['next_day']=="1") {
                        if (count($data['shift_hari_ini']) == 1) {
                            $data['absensi_hari_ini'] = $dataAbsensi->select('*')
                            ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
                            ->join('absens', 'absens.shift_id', '=', 'shifts.id')
                            ->where('user_shifts.user_id', '=', $user['id'])
                            ->where('absens.user_id', '=', $user['id'])
                            ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '>=', DB::raw('CAST(user_shifts.valid_date_start AS DATE)'))
                            ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '<=', DB::raw('CAST(user_shifts.valid_date_end AS DATE)'))
                            ->where(DB::raw('CAST(absens.created_at AS DATE)'), '>=', DB::raw('CAST(user_shifts.valid_date_start AS DATE)'))
                            ->where(DB::raw('CAST(absens.created_at AS DATE)'), '<=', DB::raw('CAST(user_shifts.valid_date_end AS DATE)'))
                            ->get();
                        }else{
                            $data['absensi_hari_ini'] = $dataAbsensi->select('*')
                            ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
                            ->join('absens', 'absens.shift_id', '=', 'shifts.id')
                            ->where('user_shifts.user_id', '=', $user['id'])
                            ->where('absens.user_id', '=', $user['id'])
                            ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '>=', DB::raw('CAST(user_shifts.valid_date_start AS DATE)'))
                            ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '<=', DB::raw('CAST(user_shifts.valid_date_end AS DATE)'))
                            ->where(DB::raw('CAST(absens.created_at AS DATE)'), '>=', DB::raw('CAST(user_shifts.valid_date_start AS DATE)'))
                            ->where(DB::raw('CAST(absens.created_at AS DATE)'), '<=', DB::raw('CAST(user_shifts.valid_date_end AS DATE)'))
                            ->where('absens.check_out', '=', NULL)
                            ->get();
                        }
                    }else{
                        $data['absensi_hari_ini'] = $dataAbsensi->select(
                            '*'
                        )
                        ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
                        ->join('absens', 'absens.shift_id', '=', 'shifts.id')
                        ->where('user_shifts.user_id', '=', $user['id'])
                        ->where('absens.user_id', '=', $user['id'])
                        ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '>=', DB::raw('CAST(user_shifts.valid_date_start AS DATE)'))
                        ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '<=', DB::raw('CAST(user_shifts.valid_date_end AS DATE)'))
                        ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '=', DB::raw('CAST(absens.created_at AS DATE)'))
                        ->get();
                    }
                    # code...
                }else{
                    $data['absensi_hari_ini'] = [];
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Get Absensi Sucessfull',
                    'data' => $data,
                ], 200);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $token = NULL): JsonResponse
    {
        //
        $get_token = AbsenTokens::select('*')
            ->where('token', '=', $token)
            ->where('used_for', '=', NULL)
            ->where('user_id', '=', NULL)
            ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '=', DB::raw('CAST(created_at AS DATE)'));
        if ($get_token->count() == 0) {
            return $this->sendError('Validation Error.', 'Token tidak tikenali atau kadaluarsa');
        }

        $validator = Validator::make($request->all(), [
            'shift_id' => 'required|exists:shifts,id',
            'user_id' => 'required|exists:users,id',
            'user_shift_id' => 'required|exists:user_shifts,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();

        $flag = Absens::select('*')
            ->where('user_id', '=', $input['user_id'])
            ->where('shift_id', '=', $input['shift_id'])
            ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '=', DB::raw('CAST(absens.created_at AS DATE)'));


        if ($flag->count() > 0) {
            if ($flag->get()[0]['check_out'] != NULL) {
                return $this->sendResponse([], 'User Already Checkout');
            } else {
                return $this->sendResponse([], 'User Already Initiate Absens');
            }
        }
        $user = Absens::create($input);
        if ($user) {
            $update_token = AbsenTokens::where('token', '=', $token)->update(['used_for' => 1, 'user_id' => Auth::user()['id']]);
            if ($update_token) {
                return $this->sendResponse([$user], 'User check-in successfully.');
            }
        }
        return $this->sendResponse([$user], 'User check-in successfully.');
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
    public function update(Request $request, Shifts $shifts, $token = NULL)
    {
        $get_token = AbsenTokens::select('*')
            ->where('token', '=', $token)
            ->where('used_for', '=', NULL)
            ->where('user_id', '=', NULL)
            ->where(DB::raw("CAST('" . Carbon::today()->toDateString() . "' AS DATE)"), '=', DB::raw('CAST(created_at AS DATE)'));
        if ($get_token->count() == 0) {
            return $this->sendError('Validation Error.', 'Token tidak tikenali atau kadaluarsa');
        }

        $validator = Validator::make($request->all(), [
            'absens_id' => 'required|exists:absens,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $absens = Absens::find($input['absens_id']);
        $absens->check_out = Carbon::now();
        if ($absens->save()) {
            $update_token = AbsenTokens::where('token', '=', $token)->update(['used_for' => 2, 'user_id' => Auth::user()['id']]);
            if ($update_token) {
                return $this->sendResponse([$absens], 'User check-out successfully.');
            }
        }
        return $this->sendResponse([$absens], 'User check-out successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shifts $shifts)
    {
        //
    }
}
