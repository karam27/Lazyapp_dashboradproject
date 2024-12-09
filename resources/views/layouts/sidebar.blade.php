<div class="w-64 bg-gray-800 text-white p-4 h-full">
    <h3 class="text-2xl font-semibold mb-6 text-center">لوحة التحكم</h3>
    <ul class="space-y-4">

        <li>
            <a href="{{ route('dashboard') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                <i class="fas fa-tachometer-alt mr-3"></i> لوحة التحكم
            </a>
        </li>




        <li>
            <a href="{{ route('admin.users') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                <i class="fas fa-users mr-3"></i> إدارة المستخدمين
            </a>
        </li>




        <li>
            <a href="{{ route('admin.doctors') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                <i class="fas fa-user-md mr-3"></i> إدارة الأطباء
            </a>
        </li>





        <li>
            <a href="{{ route('admin.eye_levels') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                <i class="fas fa-eye mr-3"></i> نتائج فحوصات العين
            </a>
        </li>

        <li>
            <a href="{{ route('admin.sessions') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                <i class="fa-solid fa-bed-pulse"></i> ادارة جلسات المرضى
            </a>
        </li>

        <li>
            <a href="{{ route('reports.admin') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                <i class="fa-solid fa-file mr-3"></i> ادارة التقارير
            </a>
        </li>


        <li>
            <a href="{{ route('admin.settings') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-all duration-300">
                <i class="fas fa-cogs mr-3"></i> إعدادات النظام
            </a>
        </li>



        <li>
            <form method="POST" action="{{ route('logout') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-all duration-100">
                @csrf
                <button type="submit" class="flex items-center text-left w-full">
                    <i class="fas fa-sign-out-alt mr-3"></i> تسجيل الخروج
                </button>
            </form>
        </li>
    </ul>
</div>
