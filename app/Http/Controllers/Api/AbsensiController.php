<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\API\BaseController;
use App\Models\Absens;
use App\Models\AbsenTokens;
use App\Models\Shifts;
use App\Models\User;
use App\Models\User_shifts;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
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
                    ->where(DB::raw("month('2024-" . $month . "-1')"), '=', DB::raw('month(user_shifts.valid_date_start)'))
                    // ->where(DB::raw("month('" . Carbon::today()->toDateString() . "'"), '=', DB::raw('month(user_shifts.valid_date_end)'))
                    ->get();

                return response()->json([
                    'success' => true,
                    'message' => 'Get Absensi Sucessfull',
                    'data' => $data,
                ], 200);
            } else {
                $yesterday = date_create(date('Y-m-d'));
                date_modify($yesterday, "-1 days");
                $dataYes = User_shifts::where('user_id', '=', $user->id)
                    ->where('valid_date_start', '=', date_format($yesterday, "Y-m-d"))
                    ->get()[0];
                if ($dataYes->shifts['next_day'] == 1 and $dataYes['check_out'] == NULL) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Get Absensi Sucessfull',
                        'data' => $dataYes,
                    ], 200);
                } else {
                    $data = User_shifts::where('user_id', '=', $user->id)
                        ->where('valid_date_start', '=', date('Y-m-d'))
                        ->get()[0];
                    return response()->json([
                        'success' => true,
                        'message' => 'Get Absensi Sucessfull',
                        'data' => $data,
                    ], 200);
                }
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
    public function update(Request $request, Shifts $shifts, $token = NULL, $check = NULL)
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
            'user_shift_id' => 'required|exists:user_shifts,id',
        ]);

        $input = $request->post();

        if ($validator) {
            $user_shift = User_shifts::find($input['user_shift_id']);
            if (is_null($user_shift['check_in']) and $check == "in") {
                $user_shift->check_in = Date('Y-m-d H:i:s');
            } elseif (is_null($user_shift['check_out']) and $check == "out") {
                $user_shift->check_out = Date('Y-m-d H:i:s');
            }
            if ($user_shift->save()) {
                $update_token = AbsenTokens::where('token', '=', $token)->update(['used_for' => 1, 'user_id' => Auth::user()['id']]);
                if ($update_token) {
                    return $this->sendResponse([$user_shift], 'User check-in successfully.');
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Absensi Sucessfull',
                'data' => $user_shift,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shifts $shifts)
    {
        //
    }
}
