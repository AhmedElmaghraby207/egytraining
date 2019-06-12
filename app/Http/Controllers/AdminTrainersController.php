<?php

namespace App\Http\Controllers;

use App\Country;
use App\Interest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminTrainersController extends Controller
{
    public function index()
    {
        $trainers = User::where('trainer', 1)->get();
        return view('admin.trainers.index', compact('trainers'));
    }

    //=========================================================//
    public function show($slug)
    {
        $trainer = User::findBySlugOrFail($slug);
        return view('admin.trainers.show', compact('trainer'));
    }

    //==============================================================//
    public function create()
    {
        $countries = Country::all();
        $interests = Interest::all();
        return view('admin.trainers.create', compact('countries', 'interests'));
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
            $request['trainer'] = 1;
            $user = User::create($request->all());
            $user->interests()->attach($request->interests);

            Session::flash('success', 'تم إضافة المتدرب بنجاح');
            return redirect()->route('trainers.index');
        }

        $request['password'] = bcrypt($request->password);
        $request['trainer'] = 1;
        $user = User::create($request->all());
        $user->interests()->attach($request->interests);

        Session::flash('success', 'تم إضافة المتدرب بنجاح');
        return redirect()->route('trainers.index');
    }

    //==============================================================//
    public function edit($slug)
    {
        $trainer = User::findBySlugOrFail($slug);
        $countries = Country::all();
        $interests = Interest::all();
        $arr[] = array($trainer->interests);
        return view('admin.trainers.edit', compact('trainer', 'countries', 'interests', 'arr'));
    }

    //==============================================================//
    public function update(Request $request, $id)
    {
        $trainer = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'user_name' => 'required|max:50|unique:users,slug' .$trainer->$id,
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|max:255',
            'image' => 'image'
        ]);

        if ($image = $request->file('image'))
        {
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('public/uploads/users', $image_new_name);
            $trainer->image = 'public/uploads/users/' . $image_new_name;

            $trainer->password = bcrypt($request->password);
            $trainer->interests()->detach();
            $trainer->interests()->attach($request->interests);
            $trainer->save();

            $trainer->update($request->except('image', 'password'));
            Session::flash('info', 'تم تعديل بيانات المتدرب بنجاح');
            return redirect()->route('trainers.index');
        }

        $trainer->password = bcrypt($request->password);
        $trainer->interests()->detach();
        $trainer->interests()->attach($request->interests);
        $trainer->save();

        $trainer->update($request->except( 'password'));
        Session::flash('info', 'تم تعديل بيانات المتدرب بنجاح');
        return redirect()->route('trainers.index');
    }

    //==============================================================//
    public function destroy($id)
    {
        $trainer = User::findOrFail($id);

        if ($trainer->coach == 1)
        {
            $trainer->trainer = 0;
            $trainer->save();
            Session::flash('error', 'تم حذف المتدرب بنجاح');
            return redirect()->route('trainers.index');
        }

        $trainer->delete();
        Session::flash('error', 'تم حذف المتدرب بنجاح');
        return redirect()->route('trainers.index');
    }

    //==============================================================//
    public function active($id)
    {
        $trainer = User::findOrFail($id);

        $trainer->active = 1;

        $trainer->save();

        Session::flash('success', 'تم تنشيط المتدرب ينجاح');
        return redirect()->back();
    }

    //==============================================================//
    public function deActive($id)
    {
        $trainer = User::findOrFail($id);

        $trainer->active = 0;

        $trainer->save();

        Session::flash('warning', 'تم تعطيل المتدرب بنجاح');
        return redirect()->back();
    }
}
