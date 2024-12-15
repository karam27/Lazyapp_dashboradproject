<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all children
        $children = Child::with(['user', 'caregiver', 'doctor'])->get();
        return response()->json($children, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'caregivers_id' => 'nullable|exists:users,id',
            'doctor_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'weak_eye' => 'nullable|in:left,right,both',
            'other_details' => 'nullable|string',
            'vision_level' => 'required|numeric|min:1|max:5',
            'last_exam_date' => 'required|date',

        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $child = Child::create($request->all());


        return response()->json([
            'message' => 'Children created successfully.',
            'children' => $child
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the child by ID with the related user data (caregiver as user)
        $child = Child::with(['user', 'caregiver', 'doctor'])->find($id);

        if (!$child) {
            return response()->json([
                'message' => 'Child not found.'
            ], 404);
        }

        return response()->json($child, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the child by ID
        $child = Child::find($id);

        if (!$child) {
            return response()->json([
                'message' => 'Child not found.'
            ], 404);
        }

        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'caregivers_id' => 'nullable|exists:users,id',
            'doctor_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'weak_eye' => 'nullable|in:left,right,both',
            'other_details' => 'nullable|string',
            'vision_level' => 'required|numeric|min:1|max:5',
            'last_exam_date' => 'required|date',
        ]);

        $child->update($request->all());


        return response()->json([
            'message' => 'Child updated successfully.',
            'child' => $child
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the child by ID
        $child = Child::find($id);

        if (!$child) {
            return response()->json([
                'message' => 'Child not found.'
            ], 404);
        }

        // Soft delete the child record
        $child->delete();

        return response()->json([
            'message' => 'Child removed successfully.'
        ], 200);
    }
}
