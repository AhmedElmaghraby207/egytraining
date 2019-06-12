<?php

namespace App\Http\Controllers;

use App\CommonQuestion;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebsiteContactsController extends Controller
{
    public function index()
    {
        $questions = CommonQuestion::all();
        return view('website.contacts.index', compact('questions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts',
            'message' => 'required'
        ]);

        Contact::create($request->all());
        Session::flash('success', 'تم الارسال بنجاح, شكرا لتواصلك معنا');
        return redirect('/');
    }
}
