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
    public function index(Request $request)
    {
        // جلب بيانات EyeLevel المرتبطة بالمستخدمين الذين لديهم دور "child"
        $query = EyeLevel::whereHas('user', function ($q) {
            $q->where('role', 'child');
        });

        if ($request->has('exam_date')) {
            $query->whereDate('exam_date', $request->exam_date);
        }

        if ($request->has('sort_by') && $request->has('order')) {
            $query->orderBy($request->sort_by, $request->order);
        }


        $eyeLevels = $query->select('id', 'user_id', 'exam_date', 'level')
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $eyeLevels,
        ], 200);
    }

    /**
     * Store a newly created eye level in storage.
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


        $eyeLevel = EyeLevel::create(
            [
                'user_id' => $request->user_id,
                'exam_date' => Carbon::parse($request->exam_date),
                'level' => $request->level,

            ]
        );

        return response()->json(
            [
                'message' => 'EyeLevel created successfully',
                'data' => $eyeLevel
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $eyeLevel = EyeLevel::with('user')->find($id);
        
        if (!$eyeLevel) {
            return response()->json(['message' => 'EyeLevel not found'], 404);
        }


        return response()->json([
            'status' => 'success',
            'data' => $eyeLevel,
        ], 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $eyeLevel = EyeLevel::findOrFail($id);


        if (!$eyeLevel) {
            return response()->json(['message' => 'EyeLevel not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'exam_date' => 'required|date',
            'level' => 'sometimes|required|string|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $eyeLevel->update(
            $request->only([
                'user_id',
                'exam_date',
                'level'
            ])
        );

        return response()->json([
            'status' => 'success',
            'data' => $eyeLevel,
        ], 200);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $eyeLevel = EyeLevel::findOrFail($id);

        if (!$eyeLevel) {
            return response()->json(['error' => 'EyeLevel not found'], 404);
        }

        // حذف السجل
        $eyeLevel->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Eye Level deleted successfully',
        ], 200);
    }
}
