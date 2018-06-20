<?php

namespace App\Http\Controllers\Site;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('pages.index', compact('doctors'));
    }

    public function saveSchedule(Request $request)
    {
        $schedule = new ScheduleController;

        return $schedule->store($request);
    }
}
