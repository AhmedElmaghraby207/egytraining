<?php

namespace App\Http\Controllers;

use App\Country;
use App\Interest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCoachesController extends Controller
{
    public function index()
    {
        $coaches = User::where('coach', 1)->get();
        return view('admin.coaches.index', compact('coaches'));
    }

    //==============================================================//
    public function show($slug)
    {
        $coach = User::findBySlugOrFail($slug);
        return view('admin.coaches.show', compact('coach'));
    }

    //==============================================================//
    public function create()
    {
        $countries = Country::all();
        $interests = Interest::all();
        return view('admin.coaches.create', compact('countries', 'interests'));
    }

    //==============================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'user_name' => 'required|max:50|unique:users',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|max:255',
            'image' => 'image'
        ]);

        if ($image = $request->file('image'))
        {
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('public/uploads/users', $image_new_name);

            $request['password'] = bcrypt($request->password);
            $request['image'] = 'public/uploads/users/' . $image_new_name;
            $request['coach'] = 1;
            $user = User::create($request->all());
            $user->interests()->attach($request->interests);

            Session::flash('success', 'تم إضافة المدرب بنجاح');
            return redirect()->route('coaches.index');
        }

        $request['password'] = bcrypt($request->password);
        $request['coach'] = 1;
        $user = User::create($request->all());
        $user->interests()->attach($request->interests);

        Session::flash('success', 'تم إضافة المدرب بنجاح');
        return redirect()->route('coaches.index');
    }

    //==============================================================//
    public function edit($slug)
    {
        $coach = User::findBySlugOrFail($slug);
        $countries = Country::all();
        $interests = Interest::all();
        $arr[] = array($coach->interests);
        //dd($arr);
        return view('admin.coaches.edit', compact('coach', 'countries', 'interests', 'arr'));
    }

    //==============================================================//
    public function update(Request $request, $id)
    {
        $coach = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'user_name' => 'required|max:50|unique:users,slug' .$coach->$id,
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|max:255',
            'image' => 'image'
        ]);


        if ($image = $request->file('image'))
        {
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('public/uploads/users', $image_new_name);
            $coach->image = 'public/uploads/users/' . $image_new_name;
            $coach->password = bcrypt($request->password);
            $coach->interests()->detach();
            $coach->interests()->attach($request->interests);
            $coach->save();

            $coach->update($request->except('image', 'password'));
            Session::flash('info', 'تم تعديل بيانات المدرب بنجاح');
            return redirect()->route('coaches.index');
        }

        $coach->password = bcrypt($request->password);
        $coach->interests()->detach();
        $coach->interests()->attach($request->interests);
        $coach->save();

        $coach->update($request->except( 'password'));
        Session::flash('info', 'تم تعديل بيانات المدرب بنجاح');
        return redirect()->route('coaches.index');
    }

    //==============================================================//
    public function destroy($id)
    {
        $coach = User::findOrFail($id);

        if ($coach->trainer == 1)
        {
            $coach->coach = 0;
            $coach->save();
            Session::flash('error', 'تم حذف المدرب بنجاح');
            return redirect()->route('coaches.index');
        }

        $coach->delete();
        Session::flash('error', 'تم حذف المدرب بنجاح');
        return redirect()->route('coaches.index');

    }

    //==============================================================//
    public function active($id)
    {
        $coach = User::findOrFail($id);

        $coach->active = 1;

        $coach->save();

        Session::flash('success', 'تم تنشيط المدرب ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function deActive($id)
    {
        $coach = User::findOrFail($id);

        $coach->active = 0;

        $coach->save();

        Session::flash('warning', 'تم تعطيل المدرب بنجاح');
        return redirect()->back();
    }

}
