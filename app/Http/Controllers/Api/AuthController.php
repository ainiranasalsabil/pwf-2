<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function getToken(Request $request)
    {
        try {

            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (!Auth::attempt($data)) {

                return response()->json([
                    'message' => 'Email atau password salah',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'message' => 'Login berhasil',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);

        } catch (\Throwable $e) {

            Log::error($e->getMessage());

            return response()->json([
                'message' => 'Terjadi error'
            ], 500);
        }
    }
}