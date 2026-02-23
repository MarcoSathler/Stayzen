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

class ProfileController extends Controller
{
    public function edit() 
    {
        $user = auth()->user();

        return view('auth.profile', compact('user'));
    }

    public function update(StoreAuthRequest $request, User $user) 
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'nullable|string',
                'role' => 'required|string'
            ]);

            if (isset($validated['password']))
            {
                $validated['password'] = $this->encrypt($validated['password']);
            }

            $user->update($validated);

            return redirect()
            ->back()
            ->with('success', 'User updated!');

        } catch(\Exception $ex) {
            return redirect()
            ->back()
            ->with('error', 'Not possible to update the user now, try again later!');
        }
    }

    public function destroy() 
    {
        
    }

    private function encrypt($value): string
    {
        return Hash::make($value);
    }
}
