<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }


        return view('admin.settings');
    }
    // تحديث الإعدادات
    public function update(Request $request)
    {

        if (!auth()->check()) {
            return redirect()->route('login'); 
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // إذا تم إدخال كلمة مرور جديدة
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('settings.edit')->with('success', 'تم تحديث الإعدادات بنجاح');
    }
}
