<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\Unit_translations;
use App\Models\User;
use App\Models\User_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Workbench\App\Models\User as ModelsUser;

class AuthenticationController extends Controller
{
    //
    /**
     * Handle an incoming authentication request.
     */
    public function store()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            // successfull authentication
            $user = User::find(Auth::user()->id);

            $user_token['token'] = $user->createToken('appToken')->accessToken;

            return response()->json([
                'success' => true,
                'token' => $user_token,
                'user' => $user,
            ], 200);
        } else {
            // failure to authenticate
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate.',
            ], 401);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if (Auth::user()) {
            $request->user()->token()->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ], 200);
        }
    }

    public function show()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $user['role'] = Roles::select('*')
            ->join('user_roles', 'roles.id', '=', 'user_roles.role_id')
            ->join('role_translations', 'role_translations.role_id', '=', 'roles.id')
            ->where('user_id', $user['id'])->get();
            $user['unit'] = Unit_translations::select('*')
            ->join('user_units', 'user_units.unit_id', '=', 'unit_translations.id')
            ->where('user_id', $user['id'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Login successfully',
                'data' => $user,
            ], 200);
        }
    }
}
