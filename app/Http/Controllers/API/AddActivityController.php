<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AddActivity;
use Illuminate\Http\Request;

class AddActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $activities = AddActivity::with(['user', 'activity'])->get();

            return response()->json([
                'message' => 'Activities fetched successfully.',
                'data' => $activities
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching the activities.',
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

        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'activities_id' => 'required|exists:activities,id',
                'vision_level' => 'nullable|numeric|max:5',
                'date' => 'required|date',
            ]);


            $addActivity = AddActivity::create($validated);

            return response()->json([
                'message' => 'Activity added successfully.',
                'data' => $addActivity
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the activity.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $addActivity = AddActivity::with(['user', 'activity'])->find($id);

            if (!$addActivity) {
                return response()->json([
                    'message' => 'Activity not found.'
                ], 404);
            }

            return response()->json([
                'message' => 'Activity fetched successfully.',
                'data' => $addActivity
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching the activity.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'activities_id' => 'required|exists:activities,id',
                'vision_level' => 'nullable|numeric|max:5',
                'date' => 'required|date',
            ]);

            $addActivity = AddActivity::findOrFail($id);

            $addActivity->update($validated);

            return response()->json([
                'message' => 'Activity updated successfully.',
                'data' => $addActivity
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the activity.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        try {
            $addActivity = AddActivity::findOrFail($id);

            $addActivity->delete();

            return response()->json([
                'message' => 'Activity deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the activity.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
