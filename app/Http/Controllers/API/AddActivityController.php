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
        return AddActivity::with(['user', 'activity'])->get();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'activities_id' => 'required|exists:activities,id',
                'vision_level' => 'nullable|numeric', // تعديل هنا لقبول الأرقام العشرية
                'date' => 'required|date',
            ]);


        $addActivity = AddActivity::create($validated);

        return response()->json($addActivity, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'activities_id' => 'required|exists:activities,id',
            'vision_level' => 'nullable|numeric', // تعديل هنا لقبول الأرقام العشرية
            'date' => 'required|date',
        ]);


        $addActivity = AddActivity::findOrFail($id);
        $addActivity->update($validated);

        return response()->json($addActivity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $addActivity = AddActivity::findOrFail($id);
        $addActivity->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
