<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {

        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        return view('doctors.index', compact('doctors'));
    }
    public function create()
    {
        return view('doctors.create');
    }
    public function edit($id)
    {
        // استرجاع المستخدم الذي سيتم تعديله
        $user = User::findOrFail($id);

        // التحقق إذا كان المستخدم لديه دور "doctor"
        if (!$user->hasRole('doctor')) {
            abort(403, 'Access Denied');
        }

        // إرسال المستخدم إلى الصفحة التي تحتوي على نموذج التعديل
        return view('doctors.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        if (!$user->hasRole('doctor')) {
            abort(403, 'Access Denied');
        }


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);


        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('doctors.index')->with('success', 'تم تعديل البيانات بنجاح');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);


        $doctor = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);


        $doctor->assignRole('doctor');


        return redirect()->route('doctors.index');
    }
    public function destroy($id)
    {

        $user = User::findOrFail($id);

        if (!$user->hasRole('doctor')) {
            abort(403, 'Access Denied');
        }


        $user->delete();


        return redirect()->route('doctors.index')->with('success', 'تم حذف الطبيب بنجاح');
    }
}
