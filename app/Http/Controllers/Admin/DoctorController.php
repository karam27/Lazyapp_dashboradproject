<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor; // إضافة نموذج Doctor
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

        $this->middleware('can:access-admin')->only(['index', 'create', 'edit', 'update', 'destroy']);
    }
    public function index()
    {
        $doctors = User::where('role', 'doctor')->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        // عرض نموذج إضافة طبيب جديد
        return view('doctors.create');
    }

    public function edit($id)
    {
        // استرجاع المستخدم الذي سيتم تعديله
        $user = User::findOrFail($id);

        // التحقق إذا كان المستخدم لديه دور "doctor"
        if ($user->role !== 'doctor') {
            abort(403, 'Access Denied');
        }

        // استرجاع معلومات الطبيب المرتبط بالمستخدم (إذا كان الدور "doctor")
        $doctor = Doctor::where('user_id', $user->id)->first();

        // إرسال المستخدم والطبيب إلى الصفحة التي تحتوي على نموذج التعديل
        return view('doctors.edit', compact('user', 'doctor'));
    }

    public function update(Request $request, $id)
    {
        // استرجاع المستخدم الذي سيتم تعديله
        $user = User::findOrFail($id);

        // التحقق إذا كان المستخدم لديه دور "doctor"
        if ($user->role !== 'doctor') {
            abort(403, 'Access Denied');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'specialization' => 'nullable|string|max:255', // إضافة التخصص
            'license_number' => 'nullable|string|max:255', // إضافة رقم الترخيص
        ]);

        // تحديث بيانات المستخدم
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        // تحديث أو إنشاء السجل في جدول doctors
        $doctor = Doctor::updateOrCreate(
            ['user_id' => $user->id], // إذا كان السجل موجودًا يتم تحديثه

        );

        return redirect()->route('doctors.index')->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // إنشاء المستخدم
        $doctor = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'doctor',  // تعيين الدور للطبيب مباشرة في الحقل `role`
        ]);

        // إنشاء السجل في جدول `doctors` بعد إنشاء المستخدم
        Doctor::create([
            'user_id' => $doctor->id, // ربط الطبيب بالمستخدم
            'name' => $validated['name'], // لازم تمرر الاسم هنا
        ]);

        return redirect()->route('doctors.index')->with('success', 'تم إضافة الطبيب بنجاح');
    }

    public function destroy($id)
    {
        // استرجاع المستخدم الذي سيتم حذفه
        $user = User::findOrFail($id);

        // التحقق إذا كان المستخدم لديه دور "doctor"
        if ($user->role !== 'doctor') {
            abort(403, 'Access Denied');
        }

        // حذف السجل من جدول `doctors`
        $doctor = Doctor::where('user_id', $user->id)->first();
        if ($doctor) {
            $doctor->delete();
        }

        // حذف المستخدم
        $user->delete();

        return redirect()->route('doctors.index')->with('success', 'تم حذف الطبيب بنجاح');
    }
}
