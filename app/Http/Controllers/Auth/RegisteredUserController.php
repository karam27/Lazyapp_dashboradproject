<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;  // إضافة نموذج Doctor
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:doctor,admin'], // تأكد من أن الدور هو doctor أو admin فقط
        ]);

        // تحقق من الدور
        if (!in_array($request->role, ['doctor', 'admin'])) {
            return back()->withErrors(['role' => 'Only doctors and admins can register.']);
        }

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // إذا كان الدور doctor، قم بإنشاء سجل doctor
        if ($request->role === 'doctor') {
            Doctor::create([
                'user_id' => $user->id,
            ]);
        }

        // إطلاق حدث التسجيل
        event(new Registered($user));

        // تسجيل الدخول مباشرة بعد التسجيل
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function authenticated(Request $request, $user)
    {
        // إذا لم يكن المستخدم من دور admin أو doctor، قم بتسجيل الخروج وعرض رسالة
        if (!in_array($user->role, ['admin', 'doctor'])) {
            Auth::logout();
            return redirect('/login')->withErrors(['role' => 'You do not have permission to access the system.']);
        }

        // إذا كان المستخدم من الأدوار المسموح بها، تابع عملية الدخول
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
