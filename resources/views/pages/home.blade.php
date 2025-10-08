@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
  <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Our Website</h1>
  <p class="text-gray-600 mb-6 text-center max-w-lg">
    This is the overview page built with Laravel 12 + Tailwind CSS.
  </p>
  <a href="{{ route('about') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
    Learn More About Us
  </a>
</div>
@endsection
