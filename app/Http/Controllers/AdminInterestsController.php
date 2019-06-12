<?php

namespace App\Http\Controllers;

use App\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;

class AdminInterestsController extends Controller
{
    public function index()
    {
        $interests = Interest::all();
        return view('admin.interests.index', compact('interests'));
    }

    //=========================================================//
    public function create()
    {
        return view('admin.interests.create');
    }

    //=========================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:interests',
        ]);

        Interest::create($request->all());
        Session::flash('success', 'تم إضافة الدولة بنجاح');
        return redirect()->route('interests.index');
    }

    //=========================================================//
    public function show($id)
    {
        return redirect()->route('interests.index');
    }

    //=========================================================//
    public function edit($slug)
    {
        $interest = Interest::findBySlugOrFail($slug);
        return view('admin.interests.edit', compact('interest'));
    }

    //=========================================================//
    public function update(Request $request, $id)
    {
        $interest = Interest::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|unique:interests,slug'.$interest->$id,
        ]);

        $interest->update($request->all());
        Session::flash('info', 'تم التعديل بنجاح');
        return redirect()->route('interests.index');


    }

    //=========================================================//
    public function destroy($id)
    {
        $interest = Interest::findOrFail($id);

        $interest->delete();

        Session::flash('error', 'تم الحذف بنجاح');
        return redirect()->back();
    }
}
