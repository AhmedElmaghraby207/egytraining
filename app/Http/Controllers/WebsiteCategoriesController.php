<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class WebsiteCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(3);
        return view('website.categories.index', compact('categories'));
    }


    //=========================================================//
    public function show($slug)
    {
        $category = Category::findBySlugOrFail($slug);
        $categories = Category::all();
        return view('website.categories.show', compact('category', 'categories'));
    }
}
