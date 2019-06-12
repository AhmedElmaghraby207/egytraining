<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCountriesController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.countries.index', compact('countries'));
    }

    //=========================================================//
    public function create()
    {
        return view('admin.countries.create');
    }

    //=========================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:countries',
        ]);
        Country::create($request->all());
        Session::flash('success', 'تم إضافة الدولة بنجاح');
        return redirect()->route('countries.index');
    }

    //=========================================================//
    public function show($id)
    {
        return redirect()->route('countries.index');
    }

    //=========================================================//
    public function edit($slug)
    {
        $country = Country::findBySlugOrFail($slug);
        return view('admin.countries.edit', compact('country'));
    }

    //=========================================================//
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:countries,slug'.$country->$id,
        ]);

        $country->update($request->all());
        Session::flash('info', 'تم تعديل الدولة بنجاح');
        return redirect()->route('countries.index');
    }

    //=========================================================//
    public function destroy($id)
    {
        $country = Country::findOrFail($id);

        $country->delete();

        Session::flash('error', 'تم حذف الدولة بنجاح');
        return redirect()->back();
    }
}
