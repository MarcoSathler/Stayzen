@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-orange-50 to-red-50">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-2xl">
        <div>
            <div class="mx-auto h-20 w-20 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                <i class="fas fa-user-plus text-white text-3xl"></i>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                Update your account
            </h2>
        </div>
        
        <form class="mt-8 space-y-6" method="POST" action="{{ route('profile.update', $user) }}">
            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           value="{{ $user->name }}">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('email') border-red-500 @enderror"
                           value="{{ $user->email }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    @if ($user->role == 'admin')
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Select your account type</label>
                        <select name="role" id="role" class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="admin" @selected($user->role == 'admin')>Admin</option>
                        </select>
                    @else
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Select your account type</label>
                        <select name="role" id="role" class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="customer" @selected($user->role == 'customer')>Customer</option>
                            <option value="seller" @selected($user->role == 'seller')>Seller</option>
                        </select>
                    @endif
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('password') border-red-500 @enderror"
                           placeholder="At least 5 characters">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" 
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent  @error('password_confirmation') border-red-500 @enderror">
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-4 px-6 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-3"></i>
                    Update account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
