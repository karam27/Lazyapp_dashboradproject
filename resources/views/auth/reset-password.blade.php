@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-lg mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">{{ __('تغيير كلمة المرور') }}</h2>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <!-- الحقل: كلمة المرور الحالية -->
                <div class="mb-5">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('كلمة المرور الحالية') }}
                    </label>
                    <input id="current_password" type="password" name="current_password"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @error('current_password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- الحقل: كلمة المرور الجديدة -->
                <div class="mb-5">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('كلمة المرور الجديدة') }}
                    </label>
                    <input id="new_password" type="password" name="new_password"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @error('new_password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- الحقل: تأكيد كلمة المرور الجديدة -->
                <div class="mb-5">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('تأكيد كلمة المرور الجديدة') }}
                    </label>
                    <input id="new_password_confirmation" type="password" name="new_password_confirmation"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <!-- زر التحديث -->
                <div>
                    <button type="submit"
                        class="w-full py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition focus:outline-none focus:ring-2 focus:ring-blue-400">
                        {{ __('تحديث كلمة المرور') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
