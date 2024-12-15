<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $sessions = Session::with(['child', 'doctor'])->get();
            return response()->json([
                'message' => 'Sessions retrieved successfully.',
                'data' => $sessions
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve sessions.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'child_id' => 'required|exists:children,id',
            'doctor_id' => 'nullable|exists:doctors,id', 
            'session_date' => 'required|date',
            'vision_level' => 'nullable|numeric|min:1|max:5',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $session = Session::create($request->all());

            return response()->json([
                'message' => 'Session created successfully.',
                'data' => $session
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create session.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $session = Session::with(['child', 'doctor'])->find($id);

            if (!$session) {
                return response()->json([
                    'message' => 'Session not found.'
                ], 404);
            }

            return response()->json([
                'message' => 'Session retrieved successfully.',
                'data' => $session
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve session.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $session = Session::find($id);

            if (!$session) {
                return response()->json([
                    'message' => 'Session not found.'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'child_id' => 'required|exists:children,id',
                'doctor_id' => 'required|exists:doctors,id',
                'session_date' => 'required|date',
                'vision_level' => 'nullable|numeric|min:0|max:9.99',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation errors.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $session->update($request->all());

            return response()->json([
                'message' => 'Session updated successfully.',
                'data' => $session
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update session.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $session = Session::find($id);

            if (!$session) {
                return response()->json([
                    'message' => 'Session not found.'
                ], 404);
            }

            $session->delete();

            return response()->json([
                'message' => 'Session deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete session.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
