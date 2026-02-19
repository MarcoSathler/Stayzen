@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-orange-50 to-red-50">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-2xl">
        <div>
            <div class="mx-auto h-20 w-20 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                <i class="fas fa-user-plus text-white text-3xl"></i>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                Create your account
            </h2>
            <p class="mt-2 text-center text-lg text-gray-600">
                Join thousands of hosts and travelers
            </p>
        </div>
        
        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="John Doe" value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('email') border-red-500 @enderror"
                           placeholder="john@example.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone (optional)</label>
                    <input id="phone" name="phone" type="tel" autocomplete="tel" 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="+55 (11) 99999-9999" value="{{ old('phone') }}">
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Select your account type</label>
                    <select name="role" id="role" class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="customer" @selected(old('role') == 'customer')>Customer</option>
                        <option value="seller" @selected(old('role') == 'seller')>Seller</option>
                    </select>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('password') border-red-500 @enderror"
                           placeholder="At least 8 characters">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-4 px-6 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-3"></i>
                    Create account
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-500">Sign in</a>
                </p>
                <p class="text-xs text-gray-500 mt-4">
                    <i class="fas fa-shield-alt text-green-500 mr-1"></i>
                    We care about your data. Read our <a href="#" class="text-orange-600 hover:underline">privacy policy</a>.
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
