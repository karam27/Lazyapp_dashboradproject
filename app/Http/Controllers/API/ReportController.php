<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivitiesExport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $activities = Activity::all()->map(function ($activity) {
            $activity->date = Carbon::parse($activity->date);
            return $activity;
        });

        return response()->json([
            'status' => 'success',
            'data' => $activities
        ], 200);
    }

    /**
     * Store a newly created activity.
     */
    public function store(Request $request)
    {
        // Validate the request data (optional but recommended)
        $validated = $request->validate([
            'child_name' => 'required|string|max:255',
            'activity_name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'date' => 'required|date',
        ]);

        // Create a new activity record
        $activity = Activity::create([
            'child_name' => $validated['child_name'],
            'activity_name' => $validated['activity_name'],
            'duration' => $validated['duration'],
            'date' => Carbon::parse($validated['date']),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Activity created successfully',
            'data' => $activity
        ], 201);
    }


    /**
     * Display a specific activity.
     */
    public function show($id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Activity not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $activity
        ], 200);
    }

    /**
     * Update a specific activity.
     */
    public function update(Request $request, $id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Activity not found'
            ], 404);
        }

        $activity->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Activity updated successfully',
            'data' => $activity
        ], 200);
    }

    /**
     * Delete a specific activity.
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Activity not found'
            ], 404);
        }

        $activity->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Activity deleted successfully'
        ], 200);
    }

    public function exportToExcel()
    {
        return Excel::download(new ActivitiesExport, 'activities.xlsx');
    }
}
