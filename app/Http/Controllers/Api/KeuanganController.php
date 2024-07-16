<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $data = ($input['data']);

        $result = Salary::insert($data);
        return response()->json([
            'success' => true,
            'message' => 'Salary created successfully.',
            'data' => $result,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $result = Salary::where('user_id', Auth::id())->get();
        return response()->json([
            'success' => true,
            'message' => 'Salary get successfully.',
            'data' => $result,
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
