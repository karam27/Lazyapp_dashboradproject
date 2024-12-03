@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <!-- عنوان إضافة المستخدم الجديد -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">إضافة مستخدم جديد</h2>

        <!-- رسالة النجاح -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- النموذج الخاص بإضافة المستخدم الجديد -->
        <form action="{{ route('users.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6 max-w-lg mx-auto">
            @csrf

            <!-- حقل اسم المستخدم -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">اسم المستخدم</label>
                <input type="text" id="name" name="name"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- حقل البريد الإلكتروني -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" id="email" name="email"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- حقل كلمة المرور -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                <input type="password" id="password" name="password"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- حقل تأكيد كلمة المرور -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تأكيد كلمة المرور</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- حقل الدور -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">الدور</label>
                <select id="role" name="role"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                </select>
                @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- زر الإرسال -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-300">
                    إضافة
                </button>
            </div>
        </form>
    </div>
@endsection
