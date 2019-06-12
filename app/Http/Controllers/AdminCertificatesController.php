<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCertificatesController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('admin.certificates.index', compact('certificates'));
    }

    //==============================================================//
    public function show($slug)
    {
        $certificate = Certificate::findBySlugOrFail($slug);
        return view('admin.certificates.show', compact('certificate'));
    }

    //==============================================================//
    public function create()
    {
        $courses = Course::all();
        $coaches = User::where('coach', 1)->get();
        return view('admin.certificates.create', compact('courses', 'coaches'));
    }

    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'cer_name' => 'required|unique:certificates',
            'cer_owner' => 'required',
        ]);

        Certificate::create($request->all());
        Session::flash('success', 'تم إضافة الشهادة بنجاح');
        return redirect()->route('admin-certificates.index');
    }

    //==============================================================//
    public function edit($slug)
    {
        $certificate = Certificate::findBySlugOrFail($slug);
        $courses = Course::all();
        $coaches = User::where('coach', 1)->get();
        return view('admin.certificates.edit', compact('certificate', 'courses', 'coaches'));
    }

    //==============================================================//
    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $this->validate($request, [
            'cer_name' => 'required|unique:certificates,slug'.$certificate->$id,
            'cer_owner' => 'required',
        ]);

        $certificate->update($request->all());
        Session::flash('info', 'تم تعديل الشهادة بنجاح');
        return redirect()->route('admin-certificates.show', $certificate->id);
    }

    //==============================================================//
    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
        Session::flash('error', 'تم حذف الشهادة بنجاح');
        return redirect()->route('admin-certificates.index');
    }

    //==============================================================//
    public function active($id)
    {
        $certificate = Certificate::findOrFail($id);

        $certificate->active = 1;

        $certificate->save();

        Session::flash('success', 'تم تنشيط الشهادة ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function deActive($id)
    {
        $certificate = Certificate::findOrFail($id);

        $certificate->active = 0;

        $certificate->save();

        Session::flash('warning', 'تم تعطيل الشهادة بنجاح');
        return redirect()->back();
    }
}
