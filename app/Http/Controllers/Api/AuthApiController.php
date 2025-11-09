<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
            // 'expires_in' => Auth::factory()->getTTL()
        ]);
    }

    // public function user()
    // {
    //     return response()->json(auth()->user());
    // }

    // public function logout()
    // {
    //     auth()->logout();
    //     return response()->json(['message' => 'Logged out successfully']);
    // }
    public function logout()
{
    auth('api')->logout();
    return response()->json(['message' => 'Logged out successfully']);
}

}
