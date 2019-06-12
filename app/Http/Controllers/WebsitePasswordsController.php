<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class WebsitePasswordsController extends Controller
{
    public function edit($slug)
    {
        $user = User::findBySlugOrFail($slug);
        return view('website.profiles.passwords.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6|max:255'
        ],[
            'old_password.required' => 'كلمة المرور القديمة مطلوبة',
            'new_password.required' => 'كلمة المرور الجديدة مطلوبة',
            'new_password.min' => 'كلمة المرور الجديدة يجب أن لا تقل عن 6 أحرف',
            'new_password.max' => 'كلمة المرور الجديدة يجب أن لا تزيد عن 255 أحرف',
            'new_password.confirmed' => 'كلمات المرور الجديدة غير متطابقة'
        ]);

        $current_password = Auth::User()->password;
        if(Hash::check($request->input('old_password'), $current_password))
        {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->input('new_password'));
            $obj_user->save();
            Session::flash('info', 'تم تغيير كلمة المرور بنجاح');
            return redirect()->route('my_profile.index');
        }
        else
        {
//            $data['errorMessage'] = 'من فضلك إدخل البيانات الصحيحة';
            Session::flash('error', 'كلمة المرور القديمة غير صحيحة');
            return redirect()->back();
        }

    }


}
