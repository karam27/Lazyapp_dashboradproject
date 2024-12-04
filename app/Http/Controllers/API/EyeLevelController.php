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
        $eyeLevels = $eyeLevels->paginate(10)->makeHidden(['created_at', 'updated_at']);;


        return response()->json([
            'status' => 'success',
            'data' => $eyeLevels,
        ], 200);
    }
}
