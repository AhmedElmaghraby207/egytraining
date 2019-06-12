<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    //=========================================================//
    public function create()
    {
        return view('admin.categories.create');
    }

    //=========================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        if ($cover = $request->file('cover'))
        {
            $this->validate($request, [
                'name' => 'required|unique:categories',
                'cover' => 'image'
            ]);

            $cover_new_name = time() . $cover->getClientOriginalName();
            $cover->move('public/uploads/categories', $cover_new_name);
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'cover' => 'public/uploads/categories/' . $cover_new_name
            ]);
        }
        else
        {
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }

        Session::flash('success', 'تم إضافة القسم بنجاح');
        return redirect()->route('admin-categories.index');
    }


    //=========================================================//
    public function show($slug)
    {
        return redirect()->route('admin-categories.index');
    }


    //=========================================================//
    public function edit($slug)
    {
        $category = Category::findBySlugOrFail($slug);
        return view('admin.categories.edit', compact('category'));
    }


    //=========================================================//
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:categories,slug'.$category->$id,
        ]);

        if ($cover = $request->file('cover'))
        {
            $this->validate($request, [
                'name' => 'required|unique:categories,slug'.$category->$id,
                'cover' => 'image'
            ]);
            $cover_new_name = time() . $cover->getClientOriginalName();
            $cover->move('public/uploads/categories', $cover_new_name);
            $category->cover = 'public/uploads/categories/'. $cover_new_name;
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        Session::flash('info', 'تم تعديل القسم بنجاح');
        return redirect()->route('admin-categories.index');

    }


    //=========================================================//
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        Session::flash('error', 'تم حذف القسم بنجاح');
        return redirect()->back();
    }
}
