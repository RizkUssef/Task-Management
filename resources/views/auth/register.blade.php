@extends('layouts.layout')

@section('title', 'Register')

@section('content')
    <form method="POST" action="{{ route('handle.register') }}" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-500 mb-1">
                Full Name
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus
                class="w-full px-4 py-2.5 rounded-lg border @error('name') border-red-400 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   transition placeholder-gray-700 text-gray-400"
                placeholder="John Doe" />
            @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-500 mb-1">
                Email Address
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="w-full px-4 py-2.5 rounded-lg border @error('email') border-red-400 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   transition placeholder-gray-700 text-gray-400"
                placeholder="you@example.com" />
            @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-500 mb-1">
                Password
            </label>
            <input id="password" type="password" name="password"
                class="w-full px-4 py-2.5 rounded-lg border @error('password') border-red-400 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   transition placeholder-gray-700 text-gray-400"
                placeholder="enter password" />
            @error('password')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-500 mb-1">
                Confirm Password
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="w-full px-4 py-2.5 rounded-lg border border-gray-300
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   transition placeholder-gray-700 text-gray-400"
                placeholder="confirm password" />
        </div>
        <div>
            <a class="text-sm font-medium text-gray-500 mb-1" href="{{ route('login') }}">already have an account, login?</a>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium
                               py-2.5 rounded-lg transition duration-200 shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Create Account
        </button>
    </form>
@endsection
