@extends('layouts.admin-auth')

@section('content')
<!-- Logo/Header -->
<div class="text-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
    <p class="text-gray-600 mt-1 text-sm">Sign in to your account</p>
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
        <x-text-input id="email" 
                      class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                      type="email" 
                      name="email"
                      :value="old('email')" 
                      required 
                      autofocus 
                      autocomplete="username" 
                      placeholder="admin@example.com" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
        <x-text-input id="password" 
                      class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                      type="password" 
                      name="password"
                      required 
                      autocomplete="current-password"
                      placeholder="••••••••" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="flex items-center mt-4">
        <label for="remember_me" class="inline-flex items-center cursor-pointer">
            <input id="remember_me" 
                   type="checkbox"
                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer"
                   name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <!-- Submit Button -->
    <div class="mt-6">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-medium py-2.5 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            {{ __('Log in') }}
        </button>
    </div>
</form>

<!-- Footer -->
<div class="text-center mt-6 pt-4 border-t border-gray-200">
    <p class="text-xs text-gray-500">
        © {{ date('Y') }} MyWebsite Admin
    </p>
</div>
@endsection