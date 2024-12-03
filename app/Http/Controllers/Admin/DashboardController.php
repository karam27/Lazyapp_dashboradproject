<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EyeLevel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $dailyExamsCount = EyeLevel::whereDate('created_at', now()->toDateString())->count();

        $newUsersCount = User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();


        return view('dashboard', compact('dailyExamsCount', 'newUsersCount'));
    }
}
