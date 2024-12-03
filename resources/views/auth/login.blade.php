@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">{{ __('تسجيل الدخول') }}</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- حقل البريد الإلكتروني -->
                <div class="mb-4">
                    <label for="email"
                        class="block text-sm font-medium text-gray-700">{{ __('البريد الإلكتروني') }}</label>
                    <input id="email" type="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                        name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- حقل كلمة المرور -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('كلمة المرور') }}</label>
                    <input id="password" type="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                        name="password" required>
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- خيار تذكرني -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input class="form-checkbox" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="ml-2 text-sm text-gray-700">{{ __('تذكرني') }}</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-blue-500 hover:underline">{{ __('نسيت كلمة المرور؟') }}</a>
                    @endif
                </div>

                <!-- زر الدخول -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        {{ __('دخول') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
