@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">إدارة الاطباء</h2>

        <!-- زر إضافة مستخدم جديد -->
        <a href="{{ route('doctors.create') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 mb-4 inline-block">
            اضافة طبيب جديد
        </a>

        <!-- جدول المستخدمين -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-40 py-3 text-right text-sm font-medium">اسم الطبيب</th>
                        <th class="px-40 py-3 text-right text-sm font-medium">البريد الإلكتروني</th>
                        <th class="px-40 py-3 text-right text-sm font-medium">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($doctors as $doctor)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-40 py-4">{{ $doctor->name }}</td>
                            <td class="px-40 py-4">{{ $doctor->email }}</td>
                            <td class="px-40 py-4">
                                <div class="space-y-2">
                                    <a href="{{ route('doctors.edit', $doctor->id) }}"
                                        class="text-blue-600 hover:underline">تعديل</a>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
