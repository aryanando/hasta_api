<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shifts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['shift'] = Shifts::select('*')->get();

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
        //
        $validator = Validator::make($request->all(), [
            'shift_name' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'color' => 'required',
            'next_day' => 'required',
            'unit_id' => 'required|exists:unit_translations,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Shift create failed.',
            ], 400);
        }
        $input = $request->all();

        return response()->json([
            'success' => true,
            'message' => 'Shift created successfully.',
            'data' => Shifts::create($input),
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
    public function destroy(string $id)
    {
        //
    }
}
