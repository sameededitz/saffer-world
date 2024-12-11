<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function handleGoogleCallback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $accessToken = $request->input('token');
        try {
            $googleUser = Socialite::driver('google')->userFromToken($accessToken);

            // Check if the user already exists
            $user = User::where('email', $googleUser->getEmail())
                ->where('auth_provider', 'google')
                ->first();

            if ($user) {
                // If user exists, update all details except email
                $user->update([
                    'auth_provider_id' => $googleUser->getId(),
                ]);
            } else {
                // If user does not exist, create a new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'auth_provider_id' => $googleUser->getId(),
                    'auth_provider' => 'google',
                    'password' => Hash::make(Str::random(10)),
                    'email_verified_at' => now(),
                ]);
            }

            // Log the user in
            Auth::login($user);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully!',
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Exception $e) {
            // Handle any exceptions
            Log::error('Error logging in with Google: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error logging in with Google: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function handleAppleCallback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $id_token = $request->input('id_token');

        try {
            $appleUser = Socialite::driver('apple')->userFromToken($id_token);

            Log::info('Apple User:', $appleUser);

            $user = User::where('email', $appleUser->getEmail())
                ->where('auth_provider', 'apple')
                ->first();

            if ($user) {
                // If user exists, update all details except email
                $user->update([
                    'auth_provider_id' => $appleUser->getId(),
                ]);
            } else {
                // If user does not exist, create a new user
                $user = User::create([
                    'name' => $appleUser->getName(),
                    'email' => $appleUser->getEmail(),
                    'auth_provider_id' => $appleUser->getId(),
                    'auth_provider' => 'google',
                    'password' => Hash::make(Str::random(10)),
                    'email_verified_at' => now(),
                ]);
            }

            // Log the user in
            Auth::login($user);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully!',
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Exception $e) {
            // Handle any exceptions
            Log::error('Error logging in with Google: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error logging in with Google: ' . $e->getMessage(),
            ], 500);
        }
    }
}
