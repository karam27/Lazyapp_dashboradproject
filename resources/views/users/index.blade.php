@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">إدارة المستخدمين</h2>

        <!-- زر إضافة مستخدم جديد -->
        <a href="{{ route('users.create') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 mb-4 inline-block">
            إضافة مستخدم جديد
        </a>

        <!-- جدول المستخدمين -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-20 py-3 text-right text-sm font-medium">اسم المستخدم</th>
                        <th class="px-20 py-3 text-right text-sm font-medium">البريد الإلكتروني</th>
                        <th class="px-20 py-3 text-right text-sm font-medium">الدور</th>
                        <th class="px-20 py-3 text-right text-sm font-medium">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <!-- اسم المستخدم -->
                            <td class="px-20 py-4">{{ $user->name }}</td>

                            <!-- البريد الإلكتروني -->
                            <td class="px-20 py-4">{{ $user->email }}</td>

                            <!-- عرض الأدوار -->
                            <td class="px-20 py-4">
                                @foreach ($user->roles as $role)
                                    <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">
                                        {{ $role->name }}
                                    </span>
                                    @if (!$loop->last)
                                        <span class="text-gray-400">,</span> <!-- فاصلة بين الأدوار -->
                                    @endif
                                @endforeach
                            </td>

                            <!-- الإجراءات -->
                            <td class="px-20 py-4">
                                <div class="flex space-x-2">
                                    <!-- رابط تعديل -->
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="text-blue-600 hover:text-blue-800 transition">تعديل</a>
                                    <!-- حذف -->
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition">حذف</button>
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
