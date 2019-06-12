<?php

namespace App\Http\Controllers;

use App\Saying;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminSayingsController extends Controller
{
    public function index()
    {
        $sayings = Saying::all();
        return view('admin.sayings.index', compact('sayings'));
    }

    //=========================================================//
    public function create()
    {
        return view('admin.sayings.create');
    }

    //=========================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sayings',
            'body' => 'required',
            'image' => 'required|image'
        ]);

            $image = $request->file('image');
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('public/uploads/sayings', $image_new_name);
            Saying::create([
                'name' => $request->name,
                'body' => $request->body,
                'image' => 'public/uploads/sayings/' . $image_new_name
            ]);


        Session::flash('success', 'تم إضافة القول بنجاح');
        return redirect()->route('sayings.index');

    }

    //=========================================================//
    public function show($id)
    {
        return redirect()->route('sayings.index');
    }

    //=========================================================//
    public function edit($slug)
    {
        $saying = Saying::findBySlugOrFail($slug);
        return view('admin.sayings.edit', compact('saying'));
    }

    //=========================================================//
    public function update(Request $request, $id)
    {
        $saying = Saying::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|unique:sayings,slug'.$saying->$id,
            'body' => 'required',
            'image' => 'required|image'
        ]);

        if ($image = $request->file('image'))
        {
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('public/uploads/sayings', $image_new_name);
            $saying->image = 'public/uploads/sayings/'. $image_new_name;
        }

        $saying->name = $request->name;
        $saying->body = $request->body;
        $saying->save();
        Session::flash('info', 'تم تعديل القول بنجاح');
        return redirect()->route('sayings.index');


    }

    //=========================================================//
    public function destroy($id)
    {
        $saying = Saying::findOrFail($id);

        $saying->delete();

        Session::flash('error', 'تم حذف القول بنجاح');
        return redirect()->back();
    }
}
