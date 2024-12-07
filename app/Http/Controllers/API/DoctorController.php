<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth::sanctum')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $doctor = User::whereHas(
            'roles',
            function ($query) {
                $query->where('name', 'doctor');
            }
        )->select('name', 'email')->get();

        return response()->json([
            'status' => 'success',
            'data' => DoctorResource::collection($doctor),

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // استرجاع الأطباء (المستخدمين الذين لديهم دور "doctor")

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $doctor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // تعيين دور الطبيب
        $doctor->assignRole('doctor');

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor created successfully',
            'data' => $doctor
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (is_null($id) || !is_numeric($id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid ID provided'
            ], 400);
        }

        $doctor = User::findOrFail($id);

        if (!$doctor->hasRole('doctor')) {
            return response()->json([
                'status' => 'error',
                'message' => 'This user is not a doctor'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => $doctor
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // استرجاع الطبيب
        $doctor = User::findOrFail($id);

        if (!$doctor->hasRole('doctor')) {
            return response()->json([
                'status' => 'error',
                'message' => 'This user is not a doctor'
            ], 403);
        }

        // التحقق من صحة المدخلات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $doctor->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        // تحديث البيانات
        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $doctor->password,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor updated successfully',
            'data' => $doctor
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = User::find($id);

        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found'
            ], 404);
        }

        if (!$doctor->hasRole('doctor')) {
            return response()->json([
                'status' => 'error',
                'message' => 'This user is not a doctor'
            ], 403);
        }

        $doctor->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor deleted successfully'
        ], 200);
    }
}
