<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivitiesExport;


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

    public function exportToExcel()
    {
        return Excel::download(new ActivitiesExport, 'activities.xlsx');
    }
}
