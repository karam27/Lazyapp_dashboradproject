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

    // public function __construct()
    // {
    //     $this->middleware('auth::sanctum')->except('index', 'show');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $doctors = Doctor::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Doctors retrieved successfully.',
            'data' => $doctors
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'number_of_cases' => 'nullable|integer|min:0',
            'contact_details' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'code' => 'required|regex:/^\d{4}$/',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        // إضافة الطبيب إلى قاعدة البيانات
        $doctor = Doctor::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
            'rating' => $request->rating,
            'number_of_cases' => $request->number_of_cases,
            'contact_details' => $request->contact_details,
            'location' => $request->location,
            'code' => $request->code,
        ]);

        // إرجاع الاستجابة مع إخفاء id
        return response()->json([
            'status' => 'success',
            'message' => 'Doctor created successfully.',
            'doctor' => new DoctorResource($doctor)  // إرجاع الـ Resource
        ], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::with('user')->find($id);  

        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor retrieved successfully.',
            'doctor' => [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'email' => $doctor->user->email,  // إرجاع الـ email من الـ User
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'number_of_cases' => 'nullable|integer|min:0',
            'contact_details' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $doctor->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor updated successfully.',
            'doctor' => $doctor
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found.'
            ], 404);
        }

        $doctor->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor removed successfully.'
        ], 200);
    }
}
