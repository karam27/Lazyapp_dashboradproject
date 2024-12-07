@extends('layouts.app')

@section('title', 'تقرير النشاط')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-6">
            <div class="bg-white shadow-lg rounded-lg p-6 space-y-6">

                <div class="flex items-center justify-between">
                    <h2 class="text-3xl font-semibold text-gray-800">تقرير النشاط</h2>
                    <a href="{{ route('reports.excel') }}"
                        class="inline-flex items-center px-6 py-2 text-white bg-green-500 rounded-lg shadow hover:bg-green-600 transition duration-300 ease-in-out">
                        <i class="fas fa-file-excel mr-2"></i> تصدير إلى Excel
                    </a>
                </div>

                @if ($activities->isEmpty())
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg" role="alert">
                        <p class="font-bold">لا توجد بيانات</p>
                        <p>لا توجد أي بيانات لعرضها في هذا التقرير.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-lg border border-gray-300">
                        <table class="table-auto w-full text-center border-collapse">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                                    <th class="border border-gray-300 px-6 py-3">رقم</th>
                                    <th class="border border-gray-300 px-6 py-3">اسم الطفل</th>
                                    <th class="border border-gray-300 px-6 py-3">الأنشطة</th>
                                    <th class="border border-gray-300 px-6 py-3">الوقت المستغرق</th>
                                    <th class="border border-gray-300 px-6 py-3">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($activities as $activity)
                                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                                        <td class="border border-gray-300 px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="border border-gray-300 px-6 py-4">{{ $activity->user->name }}</td>
                                        <!-- عرض اسم الطفل -->
                                        <td class="border border-gray-300 px-6 py-4">{{ $activity->activity_name }}</td>
                                        <td class="border border-gray-300 px-6 py-4">{{ $activity->duration }} دقيقة</td>
                                        <td class="border border-gray-300 px-6 py-4">{{ $activity->date->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
