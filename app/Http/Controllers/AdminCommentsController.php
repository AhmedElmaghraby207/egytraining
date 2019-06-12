<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Course;
use App\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }


    //==============================================================//
    public function create(Request $request)
    {
        $course_id = $request->course_id;
        $lecture_id = $request->lecture_id;
        $courses = Course::all();
        $lectures = Lecture::all();
        return view('admin.comments.create', compact('course_id', 'lecture_id', 'courses', 'lectures'));
    }


    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        Comment::create([
            'content' => $request->content,
            'course_id' => $request->course_id,
            'lecture_id' => $request->lecture_id,
        ]);
        Session::flash('success', 'تم إضافة التعليق بنجاح');
//        return redirect()->route('admin-comments.index');
        return redirect()->back();
    }


    //==============================================================//
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }


    //==============================================================//
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $courses = Course::all();
        $lectures = Lecture::all();
        return view('admin.comments.edit',compact('comment', 'courses', 'lectures'));
    }


    //==============================================================//
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        Session::flash('info', 'تم تعديل التعليق بنجاح');
        return redirect()->route('admin-comments.index');
    }


    //==============================================================//
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Session::flash('error', 'تم حذف التعليق بنجاح');
        return redirect()->back();
    }


    //==============================================================//
    public function active($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->active = 1;

        $comment->save();

        Session::flash('success', 'تم تنشيط التعليق ينجاح');
        return redirect()->back();
    }


    //==============================================================//
    public function deActive($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->active = 0;

        $comment->save();

        Session::flash('warning', 'تم تعطيل التعليق بنجاح');
        return redirect()->back();
    }
}
