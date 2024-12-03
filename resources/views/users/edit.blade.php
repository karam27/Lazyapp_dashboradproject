@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">تعديل المستخدم</h2>

        <!-- عرض النموذج لتعديل بيانات المستخدم -->
        <form action="{{ route('users.update', $user->id) }}" method="POST"
            class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
            @csrf
            @method('PUT') <!-- يستخدم PUT للتحديث بدلاً من POST -->

            <!-- اسم المستخدم -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">اسم المستخدم</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
            </div>

            <!-- البريد الإلكتروني -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
            </div>

            <!-- كلمة المرور -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                <input type="password" id="password" name="password"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>

            <!-- تأكيد كلمة المرور -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تأكيد كلمة المرور</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>

            <!-- حقل الصلاحية -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">الصلاحية</label>
                <select id="role" name="role"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
                    <option value="admin"
                        {{ old('role', $user->roles->first()->name ?? '') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                    <option value="doctor"
                        {{ old('role', $user->roles->first()->name ?? '') == 'doctor' ? 'selected' : '' }}>
                        Doctor
                    </option>
                </select>
                @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- زر الإرسال -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-300">تحديث</button>
            </div>
        </form>
    </div>
@endsection
