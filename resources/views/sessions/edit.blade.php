@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold mb-6 text-center">تعديل الجلسة</h1>

        <form action="{{ route('sessions.update', $session->id) }}" method="POST"
            class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">
            @csrf
            @method('PUT') <!-- لنقل أنه طلب تحديث -->

            <!-- اختيار الطفل المريض -->
            <div class="mb-6">
                <label for="child_id" class="block text-sm font-medium text-gray-700">الطفل المريض</label>
                <select name="child_id" id="child_id"
                    class="w-full border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled>اختر الطفل</option>
                    @foreach ($childs as $child)
                        <option value="{{ $child->id }}" {{ $child->id == $session->child_id ? 'selected' : '' }}>
                            {{ $child->name }}
                        </option>
                    @endforeach
                </select>
                @error('child_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- اختيار الطبيب -->
            <div class="mb-6">
                <label for="doctor_id" class="block text-sm font-medium text-gray-700">الطبيب</label>
                <select name="doctor_id" id="doctor_id"
                    class="w-full border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled>اختر الطبيب</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $doctor->id == $session->doctor_id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                @error('doctor_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- اختيار تاريخ الجلسة -->
            <div class="mb-6">
                <label for="session_date" class="block text-sm font-medium text-gray-700">تاريخ الجلسة</label>
                <input type="date" name="session_date" id="session_date"
                    value="{{ $session->session_date->format('Y-m-d') }}"
                    class="w-full border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('session_date')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- وصف الجلسة -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700">الوصف</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $session->description }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- زر الحفظ -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition-all duration-300">
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection
