@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-6">
            <!-- رسالة النجاح -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-lg p-6 max-w-lg mx-auto">
                <h2 class="text-2xl font-semibold mb-4">إضافة طبيب جديد</h2>
                <p class="text-lg mb-6">قم بإدخال بيانات الطبيب الجديد.</p>

                <form action="{{ route('doctors.store') }}" method="POST">
                    @csrf

                    <!-- حقل اسم الطبيب -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">اسم الطبيب</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            class="w-full p-3 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- حقل البريد الإلكتروني للطبيب -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني
                            للطبيب</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="w-full p-3 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- حقل كلمة المرور للطبيب -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                        <input id="password" type="password" name="password"
                            class="w-full p-3 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- تأكيد كلمة المرور -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تأكيد كلمة
                            المرور</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="w-full p-3 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- زر الحفظ -->
                    <div class="mb-4">
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-3 rounded-md hover:bg-blue-600 transition duration-300">
                            حفظ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
