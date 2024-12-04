<?php

namespace App\Http\Controllers\Api;

use App\Models\Poliklinik;
use Illuminate\Http\Request;

class PoliklinikController extends BaseController
{
    public function show(Request $request)
    {
        $input = $request->all();

        $result2 = Poliklinik::where('kd_poli', '=', $input['kd_poli'])
            ->get()->first();
        $message = 'Get Data Successfully';
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $result2
        ], 200);
    }
}
