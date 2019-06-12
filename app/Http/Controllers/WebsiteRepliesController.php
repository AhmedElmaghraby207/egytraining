<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebsiteRepliesController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        Reply::create([
            'content' => $request->content,
            'comment_id' => $request->comment_id,
            'user_id' => Auth::user()->id
        ]);

        Session::flash('success', 'تم إضافة الرد بنجاح');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();
        Session::flash('error', 'تم حذف الرد بنجاح');
        return redirect()->back();
    }
}
