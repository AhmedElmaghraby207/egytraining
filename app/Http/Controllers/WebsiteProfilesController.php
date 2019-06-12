<?php

namespace App\Http\Controllers;

use App\Country;
use App\Course;
use App\Interest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebsiteProfilesController extends Controller
{
    public function index()
    {
        $user = Auth::user()->first();
        $countries = Country::all();
        $courses = Course::all();
        $interests = Interest::all();

        return view('website.profiles.index', compact('user', 'countries', 'courses', 'interests'));
    }

    //=========================================================//
    public function edit($slug)
    {
        $user = User::findBySlugOrFail($slug);
        $countries = Country::all();
        $interests = Interest::all();
        return view('website.profiles.edit', compact('user', 'countries', 'interests'));
    }

    //=========================================================//
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'image' => 'image'
        ]);

        $user = User::findOrFail($id);

        if ($image = $request->file('image'))
        {
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('public/uploads/users', $image_new_name);
            $user->image = 'public/uploads/users/' . $image_new_name;
            if ($request->coach == 1)
            {
                $user->coach = 1;
            }
            elseif($request->coach != 1)
            {
                $user->coach = 0;
            }

            if ($request->trainer == 1)
            {
                $user->trainer = 1;
            }
            elseif($request->trainer != 1)
            {
                $user->trainer = 0;
            }

            $user->update($request->except('image', 'coach', 'trainer'));
            Session::flash('success', 'تم تعديل البيانات الشخصية بنجاح');
            return redirect()->route('my_profile.index');
        }

        if ($request->coach == 1)
        {
            $user->coach = 1;
        }
        elseif($request->coach != 1)
        {
            $user->coach = 0;
        }

        if ($request->trainer == 1)
        {
            $user->trainer = 1;
        }
        elseif($request->trainer != 1)
        {
            $user->trainer = 0;
        }
        $user->update($request->except('coach', 'trainer'));
        Session::flash('success', 'تم تعديل البيانات الشخصية بنجاح');
        return redirect()->route('my_profile.index');
    }

    //=========================================================//
    public function addInterests(Request $request)
    {
        $user = Auth::user();
        $user->interests()->attach($request->interests);
        Session::flash('success', 'تم إضافة الاهتمامات بنجاح');
        return redirect()->back();
    }

    //=========================================================//
    public function deleteInterest($id)
    {
        $interest = Interest::findOrFail($id);
        $user = Auth::user();
        $user->interests()->detach($interest->id);
        Session::flash('info', 'تم حذف الاهتمام بنجاح');
        return redirect()->back();
    }
}
