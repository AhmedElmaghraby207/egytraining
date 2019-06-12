<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminRepliesController extends Controller
{
    public function index()
    {
        $replies = Reply::all();
        return view('admin.replies.index', compact('replies'));
    }

    //==============================================================//
    public function create(Request $request)
    {
        $comment_id = $request->comment_id;
        return view('admin.replies.create', compact('comment_id'));
    }

    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);
        Reply::create([
            'content' => $request->content,
            'comment_id' => $request->comment_id,
        ]);
        Session::flash('success', 'تم اضافة الرد على التعليق بنجاح');
//        return redirect()->route('admin-comments.show', $request->comment_id);
        return redirect()->back();
    }

    //==============================================================//
    public function show($id)
    {
        return redirect()->route('admin-replies.index');
    }

    //==============================================================//
    public function edit($id)
    {
        $reply = Reply::findOrFail($id);
        return view('admin.replies.edit', compact('reply'));
    }

    //==============================================================//
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $reply = Reply::findOrFail($id);
        $reply->update($request->all());
        Session::flash('info', 'تم تعديل الرد على التعليق بنجاح');
        return redirect()->route('admin-comments.show', $reply->comment->id);
    }

    //==============================================================//
    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();
        Session::flash('error', 'تم حذف الرد بنجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function active($id)
    {
        $reply = Reply::findOrFail($id);

        $reply->active = 1;

        $reply->save();

        Session::flash('success', 'تم تنشيط الرد ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function deActive($id)
    {
        $reply = Reply::findOrFail($id);

        $reply->active = 0;

        $reply->save();

        Session::flash('warning', 'تم تعطيل الرد بنجاح');
        return redirect()->back();
    }
}
