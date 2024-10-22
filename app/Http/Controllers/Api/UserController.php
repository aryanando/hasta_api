<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['unit', 'jenisKaryawan',])
            ->whereNull('deleted_at')
            ->get();

        $data = array(
            'users' => $users,
        );

        return response()->json([
            'success' => true,
            'message' => 'Get Data Users Sucessfull',
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
    public function show($id)
    {
        $users = User::with([
            'unit',
            'jenisKaryawan',
            'shifts' => function ($q) {
                $q->with('shifts');
                $q->whereDate('valid_date_start', Carbon::today());
            },
            'esurvey'
        ])
            ->get()->find($id);

        $data = array(
            'users' => $users,
        );

        return response()->json([
            'success' => true,
            'message' => 'Get Data User Sucessfull',
            'data' => $data,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
