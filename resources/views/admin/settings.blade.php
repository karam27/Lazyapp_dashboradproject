@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <!-- العنوان: كلمة "الإعدادات" -->
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">الإعدادات</h2>

        <!-- رسالة النجاح عند تحديث الإعدادات -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- نموذج تحديث الإعدادات -->
        <form action="{{ route('settings.update') }}" method="POST"
            class="bg-white shadow-lg rounded-lg p-6 max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <!-- حقل اسم المستخدم -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">اسم المستخدم</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- حقل البريد الإلكتروني -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- حقل كلمة المرور الجديدة -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور الجديدة</label>
                <input type="password" id="password" name="password"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- حقل تأكيد كلمة المرور -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تأكيد كلمة المرور</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
            <!-- حقل اختيار الجنس -->
            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700">الجنس</label>
                <select id="gender" name="gender" required
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>
                        ذكر</option>
                    <option value="female"
                        {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                @error('gender')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- زر التحديث -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-300">
                    تحديث الإعدادات
                </button>
            </div>
        </form>
    </div>
@endsection
