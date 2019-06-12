<?php

namespace App\Http\Controllers;

use App\Course;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminTestsController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('admin.tests.index', compact('tests'));
    }

    //==============================================================//
    public function create(Request $request)
    {
        $coaches = User::where('coach', 1)->get();
        $courses = Course::all();
        $course_id = $request->course_id;

        return view('admin.tests.create', compact('courses', 'coaches', 'course_id'));
    }

    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|unique:tests',
            'first_ans' => 'required',
            'second_ans' => 'required',
            'third_ans' => 'required',
            'correct_ans' => 'required',
            'course_id' => 'required',
            ]);

        Test::create($request->all());
        Session::flash('success', 'تم إضافة الاختبار بنجاح');
        return redirect()->route('admin-tests.index');
    }

    //==============================================================//
    public function show($slug)
    {
        $test = Test::findBySlugOrFail($slug);
        return view('admin.tests.show', compact('test'));
    }

    //==============================================================//
    public function edit($slug)
    {
        $test = Test::findBySlugOrFail($slug);
        $coaches = User::where('coach', 1)->get();
        $courses = Course::all();
        return view('admin.tests.edit', compact('test', 'courses', 'coaches'));
    }

    //==============================================================//
    public function update(Request $request, $id)
    {
        $test = Test::findOrFail($id);

        $this->validate($request, [
            'question' => 'required|unique:tests,slug'.$test->$id,
            'first_ans' => 'required',
            'second_ans' => 'required',
            'third_ans' => 'required',
            'correct_ans' => 'required',
            'course_id' => 'required',
        ]);

        $test->update($request->all());
        Session::flash('info','تم تعديل الاختبار بنجاح');
        return redirect()->route('admin-tests.show', $test->id);
    }

    //==============================================================//
    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();
        Session::flash('error', 'تم حذف الإختبار بنجاح');
        return redirect()->route('admin-tests.index');
    }

    //==============================================================//
    public function active($id)
    {
        $test = Test::findOrFail($id);

        $test->active = 1;

        $test->save();

        Session::flash('success', 'تم تنشيط الإختبار ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function deActive($id)
    {
        $test = Test::findOrFail($id);

        $test->active = 0;

        $test->save();

        Session::flash('warning', 'تم تعطيل الإختبار بنجاح');
        return redirect()->back();
    }
}
