<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            
            Log::info('Generated token: ' . $token); // Log the token
        
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token,
            ], 200);
        }
        
    }
}
