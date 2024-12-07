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
        // استرجاع جميع الأطباء (الذين لديهم دور "doctor")

        $doctors = User::where('role', 'doctor')->with('doctor')->get();

        return response()->json($doctors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'doctor',
        ]);

        $doctor = Doctor::create([
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'The doctor has been added successfully.', 'doctor' => $doctor], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'doctor') {
            return response()->json(['error' => 'Access Denied'], 403);
        }

        $doctor = Doctor::where('user_id', $user->id)->first();

        return response()->json(['user' => $user, 'doctor' => $doctor]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'doctor') {
            return response()->json(['message' => 'This user is not a doctor'], 403);
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

        $doctor = Doctor::updateOrCreate(
            ['user_id' => $user->id],
        );

        return response()->json(['message' => 'Data has been modified successfully', 'doctor' => $doctor]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);


        if (!$user) {
            return response()->json(['error' =>'User not found'], 404);
        }

        if ($user->role !== 'doctor') {
            return response()->json(['error' => 'Access Denied'], 403);
        }

        $doctor = Doctor::where('user_id', $user->id)->first();
        if ($doctor) {
            $doctor->delete();
        }

        $user->delete();

        return response()->json(['message' => 'Doctor successfully deleted']);
    }
}
