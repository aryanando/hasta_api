<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ESurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ESurveyController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['esurvey'] = ESurvey::with(['user'])->get();
        return response()->json([
            'success' => true,
            'message' => 'Get Data Esurvey Sucessfull',
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
            'user_id' => 'required|exists:users,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = 0;
        if ($validator) {
            $imageName = time() . '.' . $request->image->extension();
            $input->image->move(public_path('images/esurvey'), $imageName);
            $product = new ESurvey();
            $product->user_id = $input->user_id;
            $product->image = 'images/' . $imageName;
            $product->save();

            return response()->json([
                'success' => true,
                'message' => 'Add Data Esurvey Sucessfull',
                'data' => $data,
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
    public function show(ESurvey $eSurvey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ESurvey $eSurvey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ESurvey $eSurvey)
    {
        //
    }
}
