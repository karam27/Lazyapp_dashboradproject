<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EyeLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EyeLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب بيانات EyeLevel المرتبطة بالمستخدمين الذين لديهم دور "child"
        $eyeLevels = EyeLevel::whereHas('user', function ($query) {
            $query->where('role', 'child');
        })->get();

        // تحويل تاريخ الفحص إلى صيغة مناسبة
        foreach ($eyeLevels as $level) {
            $level->exam_date = Carbon::parse($level->exam_date)->toDateString();
        }

        return response()->json([
            'status' => 'success',
            'data' => $eyeLevels,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'exam_date' => 'required|date',
            'level' => 'required|string|in:low,medium,high'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $eyeLevel = EyeLevel::create([
            'user_id' => $request->user_id,
            'exam_date' => Carbon::parse($request->exam_date),
            'level' => $request->level,
        ]);

        return response()->json([
            'message' => 'EyeLevel created successfully',
            'data' => $eyeLevel
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $eyeLevel = EyeLevel::with('user')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $eyeLevel,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $eyeLevel = EyeLevel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'exam_date' => 'required|date',
            'level' => 'sometimes|required|string|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $eyeLevel->update($request->only(['user_id', 'exam_date', 'level']));

        return response()->json([
            'status' => 'success',
            'data' => $eyeLevel,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eyeLevel = EyeLevel::findOrFail($id);

        $eyeLevel->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Eye Level deleted successfully',
        ], 200);
    }
}
