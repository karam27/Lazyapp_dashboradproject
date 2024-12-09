@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold mb-6 text-center">إدارة جلسات المرضى</h1>

        <!-- إضافة جلسة جديدة -->
        <div class="text-right mb-4">
            <a href="{{ route('sessions.create') }}"
                class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-all duration-300">
                إضافة جلسة جديدة
            </a>
        </div>

        <!-- جدول الجلسات -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-6">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-2 text-left">الطفل المريض</th>
                        <th class="py-3 px-4 text-left">الطبيب</th>
                        <th class="py-3 px-4 text-left">تاريخ الجلسة</th>
                        <th class="py-3 px-4 text-left">الوصف</th>
                        <th class="py-3 px-10 text-left">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $session->child->name }}</td>
                            <td class="py-3 px-4 text-left">{{ $session->doctor->user->name }}</td>
                            <td class="py-3 px-4 text-left">{{ $session->session_date }}</td>
                            <td class="py-3 px-4 text-left">{{ $session->description }}</td>
                            <td class="py-3 px-4 text-left">
                                <a href="{{ route('sessions.edit', $session->id) }}"
                                    class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 transition-all duration-300 mr-4">
                                    تعديل
                                </a>
                                <form action="{{ route('sessions.destroy', $session->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition-all duration-300 mr-2">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
