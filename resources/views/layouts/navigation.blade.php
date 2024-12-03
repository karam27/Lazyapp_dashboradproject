<nav class="bg-blue-500 p-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        {{-- اسم التطبيق --}}
        <div class="text-white text-lg font-semibold">BRIGHTEYE</div>

        {{-- الروابط --}}
        <div>
            @auth
                {{-- رابط الصفحة الرئيسية --}}
                <a href="{{ route('dashboard') }}" class="text-white mr-4">الصفحة الرئيسية</a>
            @else
                {{-- روابط تسجيل الدخول وإنشاء حساب --}}
                <a href="{{ route('login') }}" class="text-white mr-4">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="text-white">إنشاء حساب</a>
            @endauth
        </div>
    </div>
</nav>
