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
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function loginPage() 
    {
        return view('auth.login');
    }

    public function edit() 
    {
        $user = auth()->user();

        return view('auth.profile', compact('user'));
    }

    public function store(StoreAuthRequest $request)
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

    public function update(StoreAuthRequest $request)
    {
        try{
            $user = auth()->user();

            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'nullable|string',
                'role' => 'required|string'
            ]);

            if (isset($validated['password'])) {
                $validated['password'] = $this->encrypt($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()
            ->back()
            ->with('success', 'User updated!');

        } catch(\Exception $ex) {
            Log::error('Not possible to update the user now', [
                'user_id' => auth()->id(),
                'error' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return redirect()
            ->back()
            ->with('error', 'Not possible to update the user now, try again later!');
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
