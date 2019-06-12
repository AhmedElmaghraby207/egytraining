<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Admin::first();
        return view('admin.profile.index', compact('admin'));
    }

    //=========================================================//
    public function show($id)
    {
        return redirect()->route('profile.index');
    }

    //=========================================================//
    public function edit($slug)
    {
        $admin = Admin::findBySlugOrFail($slug);
        return view('admin.profile.edit', compact('admin'));
    }

    //=========================================================//
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|unique:admins,slug'.$admin->$id,
            'email' => 'required|unique:admins',
            'password' => 'required',
            'image' => 'image',
        ]);

        if($request->hasFile('image'))
        {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('public/uploads/admin', $image_new_name);
            $admin->image = 'public/uploads/admin/' . $image_new_name;
        }

        if ($request->input('password'))
        {
            $admin->password = bcrypt($request->password);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        Session::flash('info', 'تم تعديل الصفحة الشخصية بنجاح');
        return redirect()->route('profile.index');
    }
}
