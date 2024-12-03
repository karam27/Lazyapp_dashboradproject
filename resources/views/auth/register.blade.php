@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">{{ __('إنشاء حساب') }}</h2>

        <form method="POST" action="{{ route('register') }}" class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto">
            @csrf

            <!-- حقل الاسم -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('الاسم') }}</label>
                <input id="name" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                    name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- حقل البريد الإلكتروني -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('البريد الإلكتروني') }}</label>
                <input id="email" type="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                    name="email" value="{{ old('email') }}" required>
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

            <!-- حقل تأكيد كلمة المرور -->
            <div class="mb-4">
                <label for="password_confirmation"
                    class="block text-sm font-medium text-gray-700">{{ __('تأكيد كلمة المرور') }}</label>
                <input id="password_confirmation" type="password"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" name="password_confirmation" required>
            </div>

            <!-- حقل الدور -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">{{ __('الدور') }}</label>
                <select name="role" id="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="admin">admin</option>
                    <option value="doctor">doctor</option>
                </select>
                @error('role')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- زر التسجيل -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    {{ __('إنشاء حساب') }}
                </button>
            </div>
        </form>

        <!-- رابط إلى صفحة الدخول -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-700">{{ __('لديك حساب بالفعل؟') }}
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">{{ __('تسجيل الدخول') }}</a>
            </p>
        </div>
    </div>
@endsection
