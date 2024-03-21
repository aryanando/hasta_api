<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit_translations;
use App\Models\User;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['unit'] = Unit_translations::select('unit_translations.id as id', 'unit_translations.unit_name as unit_name', 'unit_translations.unit_description as unit_description', 'users.name as leader_name')
        ->join('users', 'users.id', '=', 'unit_leader_id')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Unit Sucessfull',
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
        $data['unit'] = Unit_translations::find($id);
        $data['unit']['unit_leader'] = User::find($data['unit']['unit_leader_id']);
        $data['unit']['unit_member'] = User::select('*')
        ->join('user_units', 'user_units.user_id', '=', 'users.id')
        ->where('user_units.unit_id', '=', $id)
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Unit Sucessfull',
            'data' => $data,
        ], 200);
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
