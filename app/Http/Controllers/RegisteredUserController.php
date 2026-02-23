<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function loginPage() {
        return view('auth.login');
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

            User::create($validated);

        } catch(\Exception $ex) {
            return response()->json([
                'message' => 'Fail on store user'
            ], 404);
        }
        
    }

    public function login(LoginAuthRequest $request)
    {
        try {
            $user = $request->all()['user'];
            Auth::login($user, $remember = true); // ou false

            $request->session()->regenerate();

            return redirect()->route('home');

        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex
            ], 400);
        }
        
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
    }

    private function encrypt($value): string
    {
        return Hash::make($value);
    }
}
