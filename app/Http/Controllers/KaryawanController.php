<?php

namespace App\Http\Controllers;

use App\Models\Unit_translations;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['karyawan'] = [];
        $dataKaryawan = User::select('*')
        // ->join('user_units', 'users.id', '=', 'user_units.user_id')
        // ->join('unit_translations', 'unit_translations.id', '=', 'user_units.unit_id')
        ->get();

        foreach ($dataKaryawan as $karyawan) {
            $karyawan['unit'] = Unit_translations::select('*')->join('user_units', 'user_units.unit_id', '=', 'unit_translations.id')
            ->where('user_units.user_id', '=', $karyawan['id'])->get();
            $data['karyawan'][] = $karyawan;
        }

        return response()->json([
            'success' => true,
            'message' => 'Get karyawan Sucessfull',
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
