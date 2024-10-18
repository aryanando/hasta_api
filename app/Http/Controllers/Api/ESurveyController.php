<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Esurvey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ESurveyController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['alreadyUp'] = 0;
        $data['esurvey'] = Esurvey::with(['user'])
            ->where('user_id', '=', Auth::id())
            ->get();

        foreach ($data['esurvey'] as $eSurvey) {
            // $data['flag'] = today();
            if ($eSurvey->created_at->format('M') == today()->format('M')) {
                $data['alreadyUp'] = 1;
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Get Data Esurvey Sucessfull',
            'data' => $data,
        ], 200);
    }

    public function getByParam($id = null)
    {
        if ($id == null) {
            $data['esurvey'] = User::with('esurvey')
                ->where('unit_id', '=', Auth::user()['unit_id'])
                ->get();
        } else {
            $data['esurvey'] = User::with('esurvey')
                ->where('unit_id', '=', $id)
                ->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Get Data Esurvey Sucessfull',
            'data' => $data,
        ], 200);
    }

    public function getByJenisKaryawan($id = null)
    {
        if ($id == null) {
            $data['esurvey'] = User::with('esurvey')
                ->where('jenis_karyawan_id', '=', Auth::user()['jenis_karyawan_id'])
                ->get();
        } else {
            $data['esurvey'] = User::with('esurvey')
                ->where('jenis_karyawan_id', '=', $id)
                ->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Get Data Esurvey By Jenis Karyawan Sucessfull',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request;
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);
        $data = 0;
        if (!$request->has('image')) {
            return response()->json(['message' => 'Missing file'], 422);
        }
        if ($validator) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images/esurvey'), $imageName);
            $product = new Esurvey();
            $product->user_id = Auth::id();
            $product->image = 'assets/images/esurvey/' . $imageName;
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Add Data Esurvey Sucessfull',
                'data' => true,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Add Data Esurvey Unsucessfull, User not found',
                'data' => $data,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Esurvey $eSurvey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Esurvey $eSurvey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Esurvey $eSurvey)
    {
        //
    }
}
