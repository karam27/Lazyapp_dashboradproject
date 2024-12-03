@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">لوحة التحكم</h2>
                <p class="text-lg mb-6">مرحبًا بك في لوحة التحكم. هنا يمكنك متابعة بيانات النظام.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-medium">إحصائيات اليوم</h3>
                        <p>تم إجراء {{ $dailyExamsCount }} فحص للعين اليوم.</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-medium">الأنشطة الأخيرة</h3>
                        <p>تمت إضافة {{ $newUsersCount }} مستخدم جديد هذا الأسبوع.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
