<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EyeLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EyeLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // جلب بيانات EyeLevel المرتبطة بالمستخدمين الذين لديهم دور "child"
        $eyeLevels = EyeLevel::whereHas('user', function ($query) {
            $query->role('child');
        });

        if ($request->has('exam_date')) {
            $eyeLevels->whereDate('exam_date', $request->exam_date);
        }

        if ($request->has('sort_by') && $request->has('order')) {
            $eyeLevels->orderBy($request->sort_by, $request->order);
        }

        $eyeLevels = $eyeLevels->paginate(10)->makeHidden(['created_at', 'updated_at']);;


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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'level' => 'required|integer',
            'exam_date' => 'required|date',
        ]);

        $eyeLevel = EyeLevel::create([
            'user_id' => $request->user_id,
            'level' => $request->level,
            'exam_date' => $request->exam_date,

        ]);

        return response()->json([
            'status' => 'success',
            'data' => $eyeLevel,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $eyeLevel = EyeLevel::findOrFail($id);  // البحث عن السجل باستخدام id
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
        // التحقق من وجود السجل
        $eyeLevel = EyeLevel::findOrFail($id);

        // التحقق من البيانات المدخلة
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'level' => 'required|integer',
            'exam_date' => 'required|date',
        ]);

        // تحديث السجل
        $eyeLevel->update([
            'user_id' => $request->user_id,
            'level' => $request->level,
            'exam_date' => $request->exam_date,
        ]);

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
        // التحقق من وجود السجل
        $eyeLevel = EyeLevel::findOrFail($id);

        // حذف السجل
        $eyeLevel->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Eye Level deleted successfully',
        ], 200);
    }
}
