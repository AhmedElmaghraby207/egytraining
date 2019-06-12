<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebsiteCommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        Comment::create([
            'content' => $request->content,
            'course_id' => $request->course_id,
            'lecture_id' => $request->lecture_id,
            'user_id' => Auth::user()->id
        ]);

        Session::flash('success', 'تم إضافة التعليق بنجاح');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Session::flash('error', 'تم حذف التعليق بنجاح');
        return redirect()->back();
    }
}
