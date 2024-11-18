<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\simrs\Operasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OperasiJRController extends Controller
{
    function index() {
        $result = Operasi::whereDate('tgl_operasi', Carbon::now())->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data operasi successfully.',
            'data' => $result,
        ], 200);

    }
}
