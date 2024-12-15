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
        $children = Child::all();
        return response()->json($children, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'children' => 'required|array',
            'children.*.user_id' => 'required|exists:users,id',
            'children.*.caregivers_id' => 'required|exists:users,id',
            'children.*.name' => 'required|string|max:255',
            'children.*.vision_level' => 'required|in:normal,mild,severe',
            'children.*.last_exam_date' => 'required|date',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Create the new children
        $childrenData = collect($request->children)->map(function ($childData) {
            return [
                'user_id' => $childData['user_id'],
                'caregivers_id' => $childData['caregivers_id'],
                'name' => $childData['name'],
                'vision_level' => $childData['vision_level'],
                'last_exam_date' => $childData['last_exam_date'],
            ];
        });

        // Convert the collection to array before inserting
        Child::insert($childrenData->toArray());

        return response()->json([
            'message' => 'Children created successfully.',
            'children' => $childrenData
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the child by ID with the related user data (caregiver as user)
        $child = Child::with('user', 'caregiver')->find($id);

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
            'caregivers_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'vision_level' => 'required|in:normal,mild,severe',
            'last_exam_date' => 'required|date',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Update the child record
        $child->update([
            'user_id' => $request->user_id,
            'caregivers_id' => $request->caregivers_id,
            'name' => $request->name,
            'vision_level' => $request->vision_level,
            'last_exam_date' => $request->last_exam_date,
        ]);

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
