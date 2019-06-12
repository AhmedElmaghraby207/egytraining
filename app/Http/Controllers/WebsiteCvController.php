<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebsiteCvController extends Controller
{
    public function update(Request $request, $id)
    {
        $this->validate($request,
            ['cv_url' => 'nullable|url'],
            ['cv_url.url' => 'رابط السيرة الذاتية يجب ان يكون صحيح']
        );

        $user = User::findOrFail($id);
        $user->update([
            'cv' => $request->cv,
            'cv_url' => $request->cv_url
        ]);
        Session::flash('success', 'تم تحديث السيرة الذاتية بنجاح');
        return redirect()->back();
    }
}
