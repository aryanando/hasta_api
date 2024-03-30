<?php

namespace App\Http\Controllers\Api;

use App\Models\RanapModel;
use Illuminate\Http\Request;

class RanapController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = new RanapModel();
        $dataRanap = $data->getDataRanap();
        if ($dataRanap) {
            return response()->json([
                'success' => true,
                'data' => $dataRanap,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unspected Error',
            ], 500);
        }

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
    public function show(RanapModel $ranapModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RanapModel $ranapModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RanapModel $ranapModel)
    {
        //
    }
}
