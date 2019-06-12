<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAlertsController extends Controller
{
    public function index()
    {
        $alerts = Alert::all();
        return view('admin.alerts.index', compact('alerts'));
    }


    //==============================================================//
    public function show()
    {
        return redirect()->route('admin-alerts.index');
    }


    //==============================================================//
    public function create()
    {
        $courses = Course::all();
        return view('admin.alerts.create', compact('courses'));
    }

    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:alerts',
            'content' => 'required'
        ]);

        Alert::create($request->all());
        Session::flash('success', 'تم إضافة التنويه بنجاح');
        return redirect()->route('admin-alerts.index');
    }

    //==============================================================//
    public function edit($slug)
    {
        $alert = Alert::findBySlugOrFail($slug);
        $courses = Course::all();
        return view('admin.alerts.edit',compact('alert', 'courses'));
    }

    //==============================================================//
    public function update(Request $request, $id)
    {
        $alert = Alert::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|unique:alerts,slug'.$alert->$id,
            'content' => 'required'
        ]);

        $alert->update($request->all());
        Session::flash('info', 'تم تعديل التنويه بنجاح');
        return redirect()->route('admin-alerts.index');
    }


    //==============================================================//
    public function destroy($id)
    {
        $alert = Alert::findOrFail($id);
        $alert->delete();
        Session::flash('error', 'تم حذف التنويه بنجاح');
        return redirect()->route('admin-alerts.index');
    }


    //==============================================================//
    public function active($id)
    {
        $alert = Alert::findOrFail($id);

        $alert->active = 1;

        $alert->save();

        Session::flash('success', 'تم تنشيط التنويه ينجاح');
        return redirect()->back();
    }


    //==============================================================//
    public function deActive($id)
    {
        $alert = Alert::findOrFail($id);

        $alert->active = 0;

        $alert->save();

        Session::flash('warning', 'تم تعطيل التنويه بنجاح');
        return redirect()->back();
    }


}
