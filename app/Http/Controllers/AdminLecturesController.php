<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lecture;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminLecturesController extends Controller
{
    public function index()
    {
        $lectures = Lecture::all();
        return view('admin.lectures.index', compact('lectures'));
    }

    //==============================================================//
    public function show($slug)
    {
        $lecture = Lecture::findBySlugOrFail($slug);
        return view('admin.lectures.show', compact('lecture'));
    }

    //==============================================================//
    public function create(Request $request)
    {
        $courses = Course::all();
        $coaches = User::where('coach', 1)->get();
        $course_id = $request->course_id;
        return view('admin.lectures.create', compact('courses', 'coaches', 'course_id'));
    }

    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:lectures',
            'course_id' => 'required',
            'video_link' => 'nullable|url',
            'video' => 'nullable|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime'
        ]);

        if ($video = $request->file('video'))
        {
            if($file = $request->file('file'))
            {
                $file_new_name = time() . $file->getClientOriginalName();
                $file->move('public/uploads/courses', $file_new_name);

                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);
                Lecture::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'file' => 'public/uploads/courses/' . $file_new_name,
                    'course_id' => $request->course_id,
                    'coach_id' => $request->coach_id,
                    'video' => 'public/uploads/courses/' . $video_new_name,
                    'video_link' => $request->video_link,
                ]);

                Session::flash('success', 'تم اضافة الدرس بنجاح');
                return redirect()->route('admin-lectures.index');
            }
            else
            {
                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);
                Lecture::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'course_id' => $request->course_id,
                    'coach_id' => $request->coach_id,
                    'video' => 'public/uploads/courses/' . $video_new_name,
                    'video_link' => $request->video_link,
                ]);

                Session::flash('success', 'تم اضافة الدرس بنجاح');
                return redirect()->route('admin-lectures.index');
            }
        }
        else
        {

            if($file = $request->file('file'))
            {
                $file_new_name = time() . $file->getClientOriginalName();
                $file->move('public/uploads/courses', $file_new_name);

                Lecture::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'file' => 'public/uploads/courses/' . $file_new_name,
                    'course_id' => $request->course_id,
                    'coach_id' => $request->coach_id,
                    'video_link' => $request->video_link,
                ]);

                Session::flash('success', 'تم اضافة الدرس بنجاح');
                return redirect()->route('admin-lectures.index');
            }
            else
            {
                Lecture::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'course_id' => $request->course_id,
                    'coach_id' => $request->coach_id,
                    'video_link' => $request->video_link,
                ]);

                Session::flash('success', 'تم اضافة الدرس بنجاح');
                return redirect()->route('admin-lectures.index');
            }
        }

    }

    //==========================================================================================//
    public function edit($slug)
    {
        $lecture = Lecture::findBySlugOrFail($slug);
        $courses = Course::all();
        $coaches = User::where('coach', 1)->get();

        return view('admin.lectures.edit', compact('lecture', 'courses', 'coaches'));
    }

    //==========================================================================================//
    public function update(Request $request, $id)
    {
        $lecture = Lecture::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:lectures,slug'.$lecture->$id,
            'course_id' => 'required',
            'video_link' => 'nullable|url',
            'video' => 'nullable|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime'
        ]);

        if ($video = $request->file('video'))
        {
            if($file= $request->file('file'))
            {
                $file_new_name = time() . $file->getClientOriginalName();
                $file->move('public/uploads/courses', $file_new_name);

                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);

                $lecture->name = $request->name;
                $lecture->description = $request->description;
                $lecture->course_id = $request->course_id;
                $lecture->coach_id = $request->coach_id;
                $lecture->video_link = $request->video_link;
                $lecture->video = 'public/uploads/courses/' . $video_new_name;
                $lecture->file = 'public/uploads/courses/' . $file_new_name;
                $lecture->save();

                Session::flash('info', 'تم تعديل الدرس بنجاح');
                return redirect()->route('admin-lectures.index');
            }
            else
            {
                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);

                $lecture->name = $request->name;
                $lecture->description = $request->description;
                $lecture->course_id = $request->course_id;
                $lecture->coach_id = $request->coach_id;
                $lecture->video_link = $request->video_link;
                $lecture->video = 'public/uploads/courses/' . $video_new_name;
                $lecture->save();

                Session::flash('info', 'تم تعديل الدرس بنجاح');
                return redirect()->route('admin-lectures.index');

            }
        }
        else
        {
            if($file = $request->file('file'))
            {
                $file_new_name = time() . $file->getClientOriginalName();
                $file->move('public/uploads/courses', $file_new_name);

                $lecture->name = $request->name;
                $lecture->description = $request->description;
                $lecture->course_id = $request->course_id;
                $lecture->coach_id = $request->coach_id;
                $lecture->video_link = $request->video_link;
                $lecture->file = 'public/uploads/courses/' . $file_new_name;
                $lecture->save();

                Session::flash('info', 'تم تعديل الدرس بنجاح');
                return redirect()->route('admin-lectures.index');
            }
            else
            {
                $lecture->name = $request->name;
                $lecture->description = $request->description;
                $lecture->course_id = $request->course_id;
                $lecture->coach_id = $request->coach_id;
                $lecture->video_link = $request->video_link;
                $lecture->save();

                Session::flash('info', 'تم تعديل الدرس بنجاح');
                return redirect()->route('admin-lectures.index');
            }
        }
    }

    //==============================================================//
    public function destroy($id)
    {
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();
        Session::flash('error', 'تم حذف الدرس بنجاح');
//        return redirect()->route('admin-lectures.index');
        return redirect()->back();
    }

    //==============================================================//
    public function active($id)
    {
        $lecture = Lecture::findOrFail($id);

        $lecture->active = 1;

        $lecture->save();

        Session::flash('success', 'تم تنشيط الدرس ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function deActive($id)
    {
        $lecture = Lecture::findOrFail($id);

        $lecture->active = 0;

        $lecture->save();

        Session::flash('warning', 'تم تعطيل الدرس بنجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function publish($id)
    {
        $lecture = Lecture::findOrFail($id);

        $lecture->published = 1;

        $lecture->save();

        Session::flash('success', 'تم نشر الدرس ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function unPublish($id)
    {
        $lecture = Lecture::findOrFail($id);

        $lecture->published = 0;

        $lecture->save();

        Session::flash('warning', 'تم إيقاف نشر الدرس بنجاح');
        return redirect()->back();
    }
}
