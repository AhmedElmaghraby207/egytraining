<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteAboutController extends Controller
{
    public function index()
    {
        return view('website.about.index');
    }
}
