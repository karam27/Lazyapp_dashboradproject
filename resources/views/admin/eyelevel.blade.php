@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6 text-center">نتائج فحوصات العين</h2>
                <p class="text-lg mb-6 text-center">هنا يمكنك مراقبة نتائج فحوصات العين للأطفال.</p>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-6 py-2 text-sm font-medium text-gray-700 text-center">اسم الطفل</th>
                                <th class="px-6 py-2 text-sm font-medium text-gray-700 text-center">النتيجة</th>
                                <th class="px-6 py-2 text-sm font-medium text-gray-700 text-center">تاريخ الفحص</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($eyeLevels as $level)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-800 text-center">{{ $level->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800 text-center">{{ $level->level }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800 text-center">
                                        {{ $level->exam_date->format('d-m-Y') }} <!-- عرض تاريخ الفحص -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center px-4 py-2 border border-gray-200">
                                        لا توجد بيانات لعرضها.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
