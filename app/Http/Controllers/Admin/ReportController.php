<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ActivitiesExport;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {

        $activities = Activity::all()->map(function ($activity) {

            $activity->date = Carbon::parse($activity->date);
            return $activity;
        });

        return view('admin.reports', compact('activities'));
    }
    public function exportToExcel()
    {
        return Excel::download(new ActivitiesExport, 'activities.xlsx');
    }
}
