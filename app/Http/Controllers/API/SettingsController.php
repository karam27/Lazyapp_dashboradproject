<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function edit()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'لم يتم التوثيق. يرجى تسجيل الدخول أولاً.'
            ], 401);
        }

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
        ]);
    }

    public function update(Request $request)
    {


        $user = Auth::user();

        $request->validate(['name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'gender' => 'required|in:male,female',
        ]);

        $user = Auth::user();


        $user->name = $request->name;
        $user->gender = $request->gender;

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();


        return response()->json([
            'status' => 'success',
            'message' => 'Settings have been updated successfully',
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'gender' => $user->gender,
            ],
        ], 200);
    }

    public function show()
    {
        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'data' => $user,
            'gender' => $user->gender,
        ], 200);
    }
}
