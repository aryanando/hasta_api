<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absens;
use App\Models\Shifts;
use App\Models\User_shifts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($unitOrmonth = NULL, $month = null)
    {
        //
        if ($unitOrmonth !== NULL and $month !== NULL) {
            $data['shift'] = Shifts::select(
                'shifts.id as shift_id',
                'shifts.color as shift_color',
                'shifts.shift_name as shift_name',
                'user_shifts.user_id as user_id',
                'user_shifts.valid_date_start as valid_date_start',
                'user_shifts.valid_date_end as valid_date_end',
            )
                ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
                ->join('users', 'users.id', '=', 'user_shifts.user_id')
                ->where('shifts.unit_id', '=', $unitOrmonth)
                ->where(DB::raw('month(user_shifts.valid_date_start)'), '=', $month)
                ->get();
        } else {
            $user = Auth::user();
            $data['user-shift'] = [];
            $userShift = Shifts::select(
                'shifts.id as shift_id',
                'shifts.color as shift_color',
                'shifts.shift_name as shift_name',
                'user_shifts.user_id as user_id',
                'user_shifts.valid_date_start as valid_date_start',
                'user_shifts.valid_date_end as valid_date_end',
            )
                ->join('user_shifts', 'user_shifts.shift_id', '=', 'shifts.id')
                ->join('users', 'users.id', '=', 'user_shifts.user_id')
                ->where('users.id', '=', $user['id'])
                ->where(DB::raw('month(user_shifts.valid_date_start)'), '=', $unitOrmonth)
                ->get();

                foreach ($userShift as $userShiftData) {
                    $data['user-shift'][ltrim(Carbon::parse($userShiftData['valid_date_start'])->format('d'), '0')] = $userShiftData;
                    $data['user-shift'][ltrim(Carbon::parse($userShiftData['valid_date_start'])->format('d'), '0')]['absensi'] = Absens::select('*')
                    ->where('absens.shift_id', '=', $userShiftData['shift_id'])
                    ->where('absens.user_id', '=', $userShiftData['user_id'])
                    ->where(DB::raw("CAST('" . $userShiftData['valid_date_start'] . "' AS DATE)"), '=', DB::raw('CAST(absens.check_in AS DATE)'))
                    ->get();
                }
        }

        return response()->json([
            'success' => true,
            'message' => 'Get Shift Sucessfull',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'valid_date_start' => 'required',
            'valid_date_end' => 'required',
            'user_id' => 'required|exists:users,id',
            'shift_id' => 'required|exists:shifts,id',
        ]);



        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'User Shift create failed.',
            ], 400);
        }
        $input = $request->all();

        if ($input['last_shift_id'] !== 'NULL') {
            $input2 = $input;
            $input2['shift_id'] = $input['last_shift_id'];
            unset($input2['last_shift_id']);
            unset($input['last_shift_id']);
            $result['data'] = User_shifts::where('shift_id', $input['shift_id'])
                ->where('user_id', $input['user_id'])
                ->where('valid_date_end', $input['valid_date_end'])
                ->where('valid_date_start', $input['valid_date_start'])
                ->update(['shift_id' => $input2['shift_id']]);
            $result['shift_data'] = Shifts::find($input2['shift_id']);
        } else {
            $result = User_shifts::create($input);
            $result['shift_data'] = Shifts::find($input['shift_id']);
        }



        return response()->json([
            'success' => true,
            'message' => 'User Shift created successfully.',
            'data' => $result,
        ], 200);
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
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'valid_date_start' => 'required',
            'valid_date_end' => 'required',
            'user_id' => 'required|exists:users,id',
            'shift_id' => 'required|exists:shifts,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'User Shift delete failed.',
            ], 400);
        }
        $input = $request->all();
        $result['data'] = User_shifts::where('shift_id', $input['shift_id'])
            ->where('user_id', $input['user_id'])
            ->where('valid_date_end', $input['valid_date_end'])
            ->where('valid_date_start', $input['valid_date_start'])
            ->delete();

        if ($result['data'] > 0) {
            return response()->json([
                'success' => true,
                'message' => 'User Shift delete successfully.',
                'data' => $result,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Shift delete failed.',
                'data' => $input,
            ], 400);
        }
    }
}
