<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EyeLevel;
use Carbon\Carbon;

class EyeLevelController extends Controller
{
    public function index()
    {

        $eyeLevels = EyeLevel::whereHas('user', function ($query) {
            $query->where('role', 'child');
        })->get();


        foreach ($eyeLevels as $level) {
            $level->exam_date = Carbon::parse($level->exam_date);
        }

        return view('admin.eyelevel', compact('eyeLevels'));
    }
}
