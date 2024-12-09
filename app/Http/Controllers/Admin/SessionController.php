<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Doctor;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::with('doctor', 'child')->get();
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $childs = Child::all();
        $doctors = Doctor::all();
        return view('sessions.create', compact('childs', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required',
            'doctor_id' => 'required',
            'session_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Session::create($request->all());
        return redirect()->route('admin.sessions');
    }

    /**
     * Display the specified resource.


     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        $childs = Child::all();
        $doctors = Doctor::all();
        $session->session_date = Carbon::parse($session->session_date);
        return view('sessions.edit', compact('session', 'childs', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        $request->validate([
            'child_id' => 'required',
            'doctor_id' => 'required',
            'session_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $session->update($request->all());
        return redirect()->route('admin.sessions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return redirect()->route('admin.sessions');
    }
}
