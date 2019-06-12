<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Comment;

class AdminCoursesController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    //==============================================================//
    public function show($slug)
    {
        $course = Course::findBySlugOrFail($slug);
        return view('admin.courses.show', compact('course'));
    }

    //==============================================================//
    public function create()
    {
        $categories = Category::all();
        $coaches = User::where('coach', 1)->get();
        return view('admin.courses.create', compact('categories', 'coaches'));
    }


    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:courses',
            'category_id' => 'required',
            'video_link' => 'nullable|url',
            'video' => 'nullable|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime'
        ]);

        if ($video = $request->file('video'))
        {

            if($cover = $request->file('cover'))
            {
                $cover_new_name = time() . $cover->getClientOriginalName();
                $cover->move('public/uploads/courses', $cover_new_name);

                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);
                Course::create([
                    'name' => $request->name,
                    'needs' => $request->needs,
                    'description' => $request->description,
                    'cover' => 'public/uploads/courses/' . $cover_new_name,
                    'category_id' => $request->category_id,
                    'coach_id' => $request->coach_id,
                    'video' => 'public/uploads/courses/' . $video_new_name,
                    'video_link' => $request->video_link,
                    'male' => $request->male,
                    'female' => $request->female,
                    'status' => $request->status,
                    'price' => $request->price,
                    'start_at' => $request->start_at,
                    'finish_at' => $request->finish_at,
                ]);

                Session::flash('success', 'تم إضافة الدورة بنجاح');
                return redirect()->route('admin-courses.index');
            }
            else
            {
                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);
                Course::create([
                    'name' => $request->name,
                    'needs' => $request->needs,
                    'description' => $request->description,
                    'category_id' => $request->category_id,
                    'coach_id' => $request->coach_id,
                    'video' => 'public/uploads/courses/' . $video_new_name,
                    'video_link' => $request->video_link,
                    'male' => $request->male,
                    'female' => $request->female,
                    'status' => $request->status,
                    'price' => $request->price,
                    'start_at' => $request->start_at,
                    'finish_at' => $request->finish_at,
                ]);

                Session::flash('success', 'تم إضافة الدورة بنجاح');
                return redirect()->route('admin-courses.index');
            }
        }
        else
        {

            if($cover = $request->file('cover'))
            {
                $cover_new_name = time() . $cover->getClientOriginalName();
                $cover->move('public/uploads/courses', $cover_new_name);

                Course::create([
                    'name' => $request->name,
                    'needs' => $request->needs,
                    'description' => $request->description,
                    'cover' => 'public/uploads/courses/' . $cover_new_name,
                    'category_id' => $request->category_id,
                    'coach_id' => $request->coach_id,
                    'video_link' => $request->video_link,
                    'male' => $request->male,
                    'female' => $request->female,
                    'status' => $request->status,
                    'price' => $request->price,
                    'start_at' => $request->start_at,
                    'finish_at' => $request->finish_at,
                ]);

                Session::flash('success', 'تم إضافة الدورة بنجاح');
                return redirect()->route('admin-courses.index');
            }
            else
            {
                Course::create([
                    'name' => $request->name,
                    'needs' => $request->needs,
                    'description' => $request->description,
                    'category_id' => $request->category_id,
                    'coach_id' => $request->coach_id,
                    'video_link' => $request->video_link,
                    'male' => $request->male,
                    'female' => $request->female,
                    'status' => $request->status,
                    'price' => $request->price,
                    'start_at' => $request->start_at,
                    'finish_at' => $request->finish_at,
                ]);

                Session::flash('success', 'تم إضافة الدورة بنجاح');
                return redirect()->route('admin-courses.index');
            }
        }
    }

    //==========================================================================================//
    public function edit($slug)
    {
        $course = Course::findBySlugOrFail($slug);
        $categories = Category::all();
        $coaches = User::where('coach', 1)->get();

        return view('admin.courses.edit', compact('course', 'categories', 'coaches'));
    }

    //==========================================================================================//
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:courses,slug' .$course->$id,
            'category_id' => 'required',
            'video_link' => 'nullable|url',
            'video' => 'nullable|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime'
        ]);

        if ($video = $request->file('video'))
        {

            if($cover = $request->file('cover'))
            {
                $cover_new_name = time() . $cover->getClientOriginalName();
                $cover->move('public/uploads/courses', $cover_new_name);

                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);

                $course->name = $request->name;
                $course->needs = $request->needs;
                $course->description = $request->description;
                $course->start_at = $request->start_at;
                $course->finish_at = $request->finish_at;
                $course->cover = 'public/uploads/courses/' . $cover_new_name;
                $course->category_id = $request->category_id;
                $course->coach_id = $request->coach_id;
                $course->video = 'public/uploads/courses/' . $video_new_name;
                $course->video_link = $request->video_link;
                $course->male = $request->male;
                $course->female = $request->female;
                $course->status = $request->status;
                $course->price = $request->price;
                $course->save();

                Session::flash('info', 'تم تعديل الدورة بنجاح');
                return redirect()->route('admin-courses.show', $course->slug);
            }
            else
            {
                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);

                $course->name = $request->name;
                $course->needs = $request->needs;
                $course->description = $request->description;
                $course->category_id = $request->category_id;
                $course->coach_id = $request->coach_id;
                $course->start_at = $request->start_at;
                $course->finish_at = $request->finish_at;
                $course->video = 'public/uploads/courses/' . $video_new_name;
                $course->video_link = $request->video_link;
                $course->male = $request->male;
                $course->female = $request->female;
                $course->status = $request->status;
                $course->price = $request->price;
                $course->save();

                Session::flash('info', 'تم تعديل الدورة بنجاح');
                return redirect()->route('admin-courses.show', $course->slug);

            }
        }
        else
        {
            if($cover = $request->file('cover'))
            {
                $cover_new_name = time() . $cover->getClientOriginalName();
                $cover->move('public/uploads/courses', $cover_new_name);

                $course->name = $request->name;
                $course->needs = $request->needs;
                $course->description = $request->description;
                $course->start_at = $request->start_at;
                $course->finish_at = $request->finish_at;
                $course->cover = 'public/uploads/courses/' . $cover_new_name;
                $course->category_id = $request->category_id;
                $course->coach_id = $request->coach_id;
                $course->video_link = $request->video_link;
                $course->male = $request->male;
                $course->female = $request->female;
                $course->status = $request->status;
                $course->price = $request->price;
                $course->save();

                Session::flash('info', 'تم تعديل الدورة بنجاح');
                return redirect()->route('admin-courses.show', $course->slud);
            }
            else
            {
                $course->name = $request->name;
                $course->needs = $request->needs;
                $course->description = $request->description;
                $course->start_at = $request->start_at;
                $course->finish_at = $request->finish_at;
                $course->category_id = $request->category_id;
                $course->coach_id = $request->coach_id;
                $course->video_link = $request->video_link;
                $course->male = $request->male;
                $course->female = $request->female;
                $course->status = $request->status;
                $course->price = $request->price;
                $course->save();

                Session::flash('info', 'تم تعديل الدورة بنجاح');
                return redirect()->route('admin-courses.show', $course->slug);
            }
        }
    }

    //==============================================================//
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        Session::flash('error', 'تم حذف الكورس بنجاح');
        return redirect()->route('admin-courses.index');
    }

    //==============================================================//
    public function active($id)
    {
        $course = Course::findOrFail($id);

        $course->active = 1;

        $course->save();

        Session::flash('success', 'تم تنشيط الكورس ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function deActive($id)
    {
        $course = Course::findOrFail($id);

        $course->active = 0;

        $course->save();

        Session::flash('warning', 'تم تعطيل الكورس بنجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function publish($id)
    {
        $course = Course::findOrFail($id);

        $course->published = 1;

        $course->save();

        Session::flash('success', 'تم نشر الكورس ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function unPublish($id)
    {
        $course = Course::findOrFail($id);

        $course->published = 0;

        $course->save();

        Session::flash('warning', 'تم إيقاف نشر الكورس بنجاح');
        return redirect()->back();
    }
}
