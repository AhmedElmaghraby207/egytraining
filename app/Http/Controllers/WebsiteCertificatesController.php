<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebsiteCertificatesController extends Controller
{

    public function show($slug)
    {
        $certificate = Certificate::findBySlugOrFail($slug);
        return view('website.certificates.show', compact('certificate'));
    }

    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        return view('website.certificates.create', compact('course'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cer_name' => 'required|unique:certificates',
            'cer_owner' => 'required',
            'cer_status' => 'required',
            'cer_price' => 'required_if:cer_status,1'
        ]);

        $course = Course::findOrFail($request->course_id);

        Certificate::create([
            'coach_id' => $course->coach->id,
            'course_id' => $course->id,
            'cer_name' => $request->cer_name,
            'cer_owner' => $request->cer_owner,
            'cer_status' => $request->cer_status,
            'cer_price' => $request->cer_price
        ]);
        Session::flash('success', 'تم إضافة الشهادة للدورة بنجاح');
        return redirect()->route('courses.show', $course->slug);
    }

    public function edit($slug)
    {
        $certificate = Certificate::findBySlugOrFail($slug);
        return view('website.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cer_name' => 'required|unique:certificates',
            'cer_owner' => 'required',
            'cer_status' => 'required',
            'cer_price' => 'required_if:cer_status,1'
        ]);

        $course = Course::findOrFail($request->course_id);

        $certificate = Certificate::findOrFail($id);
        $certificate->update($request->all());
        Session::flash('info', 'تم تعديل الشهادة بنجاح');
        return redirect()->route('courses.show', $course->slug);
    }

    public function destroy(Request $request, $id)
    {
        $course = Course::findOrFail($request->course_id);

        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
        Session::flash('error', 'تم حذف الشهادة بنجاح');
        return redirect()->route('courses.show', $course->slug);
    }
}
