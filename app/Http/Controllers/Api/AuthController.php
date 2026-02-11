<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    public function register(StoreAuthRequest $request): JsonResponse
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
                'role' => 'required|string'
            ]);

            $validated['password'] = $this->encrypt($validated['password']);
            $validated['remember_token'] = Str::random(10);

            $user = User::create($validated);

            return response()->json(['user' => $user], 201);
        } catch(\Exception $ex) {
            return response()->json([
                'message' => 'Fail on register user'
            ], 404);
        }
        
    }

    public function login(LoginAuthRequest $request): JsonResponse
    {
        try {
            $user = $request->all()['user'];

            $user->tokens()->delete();

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex
            ], 400);
        }
        
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Logout done'
        ], 200);
    }

    private function encrypt($value): string
    {
        return Hash::make($value);
    }
}