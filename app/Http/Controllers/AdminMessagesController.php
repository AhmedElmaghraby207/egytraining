<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMessagesController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('admin.messages.index', compact('messages'));
    }

    //==============================================================//
    public function create()
    {
        return view('admin.messages.create');
    }

    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
           'content' => 'required'
        ]);

        Message::create($request->all());
        Session::flash('success', 'تم إضافة الرسالة بنجاح');
        return redirect()->route('admin-messages.index');
    }

    //==============================================================//
    public function show($id)
    {
        return redirect()->route('admin-messages.index');
    }

    //==============================================================//
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.edit', compact('message'));
    }

    //==============================================================//
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $message = Message::findOrFail($id);
        $message->update($request->all());
        Session::flash('info', 'تم تعديل الرسالة بنجاح');
        return redirect()->route('admin-messages.index');
    }

    //==============================================================//
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        Session::flash('error', 'تم حذف الرسالة بنجاح');
        return redirect()->route('admin-messages.index');
    }

    //==============================================================//
    public function active($id)
    {
        $message = Message::findOrFail($id);

        $message->active = 1;

        $message->save();

        Session::flash('success', 'تم تنشيط الرسالة ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function deActive($id)
    {
        $message = Message::findOrFail($id);

        $message->active = 0;

        $message->save();

        Session::flash('warning', 'تم تعطيل الرسالة بنجاح');
        return redirect()->back();
    }


}
