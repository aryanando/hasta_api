<?php

namespace App\Http\Controllers\Api;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengumuman::orderBy('id', 'DESC')->get();
        return response()->json([
            'success' => true,
            'message' => 'Get Pengumuman Sucessfull',
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
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        //
    }
}
