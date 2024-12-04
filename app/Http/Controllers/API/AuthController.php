<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['token' => $user->createToken('YourAppName')->plainTextToken]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);

    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if ($user) {
    //         if (Hash::check($request->password, $user->password)) {
    //             Auth::login($user);

    //             $token = $user->createToken('login')->plainTextToken;

    //             return response()->json([
    //                 'message' => 'Login Successfully',
    //                 'status' => 'Success',
    //                 'data' => [
    //                     'token' => $token
    //                 ]
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'message' => 'Password does Not Match',
    //                 'status' => 'Success',
    //                 'data' => []
    //             ], 200);
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => 'No User Found',
    //             'status' => 'Success',
    //             'data' => []
    //         ], 404);
    //     }
    }


    // public function register(Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     // Generate a personal access token for the new user
    //     $token = $user->createToken('register')->plainTextToken;

    //     return response()->json([
    //         'message' => 'Registration Successful',
    //         'status' => 'Success',
    //         'data' => [
    //             'token' => $token
    //         ]
    //     ], 201);
    // }
}
