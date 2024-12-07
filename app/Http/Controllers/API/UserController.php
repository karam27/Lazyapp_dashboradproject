<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth::sanctum')->except('index' , 'show');
    }

    private function formatUser($user)
    {
        // Lazy load the roles relationship
        $user->load('roles');

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->roles->pluck('name'),
        ];

        // If the user is a doctor, add doctor-related information
        if ($user->roles->contains('doctor')) {
            $doctor = Doctor::where('user_id', $user->id)->first();
            $formattedUser['doctor'] = [
                'specialization' => $doctor->specialization ?? null,
                'license_number' => $doctor->license_number ?? null,
            ];
        }

        return $formattedUser;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with('roles')->get()->map(fn($user) => $this->formatUser($user));


        return response()->json([
            'status' => 'success',
            'data' => $users
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|exists:roles,name',
            'specialization' => 'nullable|string',
            'license_number' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        if ($request->role === 'doctor') {
            Doctor::create([
                'user_id' => $user->id,
                'specialization' => $request->specialization,
                'license_number' => $request->license_number,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::with('roles')->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $this->formatUser($user)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|exists:roles,name',
            'specialization' => 'nullable|string',
            'license_number' => 'nullable|string',
        ]);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);

        $user->syncRoles($validated['role']);

        // Update doctor information if the user is a doctor
        if ($validated['role'] === 'doctor') {
            Doctor::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'specialization' => $validated['specialization'],
                    'license_number' => $validated['license_number'],
                ]
            );
        } else {
            Doctor::where('user_id', $user->id)->delete();
        }

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ], 200);
    }
}
