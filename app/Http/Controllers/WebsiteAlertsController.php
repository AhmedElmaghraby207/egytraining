<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Course;
use Illuminate\Http\Request;

class WebsiteAlertsController extends Controller
{
    public function index(Request $request)
    {
        $course_id = $request->course_id;
        $course = Course::findOrFail($course_id);
        $alerts = Alert::where('course_id' ,$course_id);
        return view('website.alerts.index', compact('alerts', 'course'));
    }
}
