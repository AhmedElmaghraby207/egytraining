<?php

namespace App\Http\Controllers;

use App\Course;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebsiteTestsController extends Controller
{

    public function index(Request $request)
    {
        $course_id = $request->course_id;
        $course = Course::findOrFail($course_id);
        $tests = Test::where('course_id' ,$course_id);
        return view('website.tests.index', compact('tests', 'course'));
    }

    //=============================================================//
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        return view('website.tests.create', compact('course'));
    }

    //=============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'first_ans' => 'required',
            'second_ans' => 'required',
            'third_ans' => 'required',
            'correct_ans' => 'required',
        ]);

        $course = Course::findOrFail($request->course_id);

        Test::create([
            'question' => $request->question,
            'first_ans' => $request->first_ans,
            'second_ans' => $request->second_ans,
            'third_ans' => $request->third_ans,
            'correct_ans' => $request->correct_ans,
            'course_id' => $request->course_id,
            'coach_id' => Auth::user()->id
        ]);

        Session::flash('success', 'تم إضافة الاختبار بنجاح');
        return redirect()->route('courses.show', $course->slug);
    }
}
