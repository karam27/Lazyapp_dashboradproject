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
                <h2 class="text-2xl font-semibold mb-4">تعديل بيانات الطبيب</h2>
                <p class="text-lg mb-6">قم بتعديل بيانات الطبيب.</p>

                <form action="{{ route('doctors.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- استخدام PUT لتحديث البيانات -->

                    <!-- حقل اسم الطبيب -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">اسم الطبيب</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full p-3 border border-gray-300 rounded-md" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- حقل البريد الإلكتروني للطبيب -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني
                            للطبيب</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full p-3 border border-gray-300 rounded-md" required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- حقل كلمة المرور -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                        <input id="password" type="password" name="password"
                            class="w-full p-3 border border-gray-300 rounded-md">
                        <p class="text-sm text-gray-500">إذا كنت لا تريد تغيير كلمة المرور، يمكنك ترك هذا الحقل فارغًا.</p>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- حقل تأكيد كلمة المرور -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تأكيد كلمة
                            المرور</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="w-full p-3 border border-gray-300 rounded-md">
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- زر التحديث -->
                    <div class="mb-4">
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-3 rounded-md hover:bg-blue-600 transition duration-300">
                            تحديث البيانات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
