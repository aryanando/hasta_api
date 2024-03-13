<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\AbsenTokens;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AbsensiTokenController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $old_token = AbsenTokens::select('*')
        ->where('created_by', '=', Auth::user()['id'])
        ->where('used_for', '=', NULL)
        ->where('user_id', '=', NULL)
        ->where(DB::raw("CAST('".Carbon::today()->toDateString()."' AS DATE)"), '=', DB::raw('CAST(created_at AS DATE)'));
        // ->count();
        if ($old_token->count() > 0) {
            return $this->sendResponse([$old_token->get()],'Token Created.');
        }
        $new_token = [
            'token' => Str::random(16),
            'created_by' => Auth::user()['id']
        ];
        $token = AbsenTokens::create($new_token);
        return $this->sendResponse([$token],'Token Created.');
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
    public function show(AbsenTokens $absenTokens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AbsenTokens $absenTokens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AbsenTokens $absenTokens)
    {
        //
    }
}
