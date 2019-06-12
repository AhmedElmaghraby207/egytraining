<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebsiteLecturesController extends Controller
{

    public function index(Request $request)
    {
        $course_id = $request->course_id;
        $course = Course::findOrFail($course_id);
        $lectures = Lecture::where('course_id' ,$course_id);
        return view('website.lectures.index', compact('lectures', 'course'));
    }

    //=========================================================//
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        return view('website.lectures.create', compact('course'));
    }

    //=========================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:lectures',
            'video_link' => 'nullable|url',
            'video' => 'nullable|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime',
        ]);

        $course = Course::findOrFail($request->course_id);

        $coach = Auth::user();
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
                    'course_id' => $course->id,
                    'coach_id' => $coach->id,
                    'video' => 'public/uploads/courses/' . $video_new_name,
                    'video_link' => $request->video_link,
                    'file' => 'public/uploads/courses/' . $file_new_name,
                ]);

                Session::flash('success', 'تم اضافة الدرس بنجاح');
                return redirect()->route('courses.show', $course->slug);
            }
            else
            {
                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);
                Lecture::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'course_id' => $request->course_id,
                    'coach_id' => $coach->id,
                    'video' => 'public/uploads/courses/' . $video_new_name,
                    'video_link' => $request->video_link,
                ]);

                Session::flash('success', 'تم اضافة الدرس بنجاح');
                return redirect()->route('courses.show', $course->slug);
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
                    'coach_id' => $coach->id,
                    'video_link' => $request->video_link,

                ]);

                Session::flash('success', 'تم اضافة الدرس بنجاح');
                return redirect()->route('courses.show', $course->slug);
            }
            else
            {
                Lecture::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'course_id' => $request->course_id,
                    'coach_id' => $coach->id,
                    'video_link' => $request->video_link,
                ]);

                Session::flash('success', 'تم اضافة الدرس بنجاح');
                return redirect()->route('courses.show', $course->slug);
            }
        }

    }

    //=========================================================//
    public function show($slug)
    {
        $lecture = Lecture::findBySlugOrFail($slug);

        $next = Lecture::where('id', '>', $lecture->id)->where('course_id', $lecture->course_id)->orderBy('id')->first();
        $prev = Lecture::where('id', '<', $lecture->id)->where('course_id', $lecture->course_id)->orderBy('id','desc')->first();

        return view('website.lectures.show', compact('lecture', 'next', 'prev'));
    }

    //=========================================================//
    public function edit($slug)
    {
        $lecture = Lecture::findBySlugOrFail($slug);
        return view('website.lectures.edit', compact('lecture'));
    }

    //=========================================================//
    public function update(Request $request, $id)
    {
        $lecture = Lecture::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:lectures,slug'.$lecture->$id,
            'video_link' => 'nullable|url',
//            'video_link' => 'required_if:check,0|url',
            'video' => 'nullable|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime',
        ]);

        if ($video = $request->file('video'))
        {

            if($file = $request->file('file'))
            {
                $file_new_name = time() . $file->getClientOriginalName();
                $file->move('public/uploads/courses', $file_new_name);

                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);

                $lecture->name = $request->name;
                $lecture->description = $request->description;
                $lecture->file = 'public/uploads/lectures/' . $file_new_name;
                $lecture->video = 'public/uploads/lectures/' . $video_new_name;
                $lecture->video_link = $request->video_link;
                $lecture->save();

                Session::flash('info', 'تم تعديل الدرس بنجاح');
                return redirect()->route('lectures.show', $lecture->slug);
            }
            else
            {
                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);

                $lecture->name = $request->name;
                $lecture->description = $request->description;
                $lecture->video = 'public/uploads/courses/' . $video_new_name;
                $lecture->video_link = $request->video_link;
                $lecture->save();

                Session::flash('info', 'تم تعديل الدرس بنجاح');
                return redirect()->route('lectures.show', $lecture->slug);
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
                $lecture->file = 'public/uploads/courses/' . $file_new_name;
                $lecture->video_link = $request->video_link;
                $lecture->save();

                Session::flash('info', 'تم تعديل الدرس بنجاح');
                return redirect()->route('lectures.show', $lecture->slug);
            }
            else
            {
                $lecture->name = $request->name;
                $lecture->description = $request->description;
                $lecture->video_link = $request->video_link;
                $lecture->save();

                Session::flash('info', 'تم تعديل الدرس بنجاح');
                return redirect()->route('lectures.show', $lecture->slug);
            }
        }
    }

    //=========================================================//
    public function destroy($id)
    {
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();
        Session::flash('error', 'تم حذف الدرس بنجاح');
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
