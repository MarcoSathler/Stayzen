<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(StoreAuthRequest $request)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'nullable|string',
                'password' => 'required|string',
                'role' => 'required|string'
            ]);

            $validated['password'] = $this->encrypt($validated['password']);
            $validated['remember_token'] = Str::random(10);

            $user = User::create($validated);

            
        } catch(\Exception $ex) {
            return response()->json([
                'message' => 'Fail on store user'
            ], 404);
        }
        
    }

    private function encrypt($value): string
    {
        return Hash::make($value);
    }
}
