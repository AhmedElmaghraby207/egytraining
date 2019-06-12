<?php

namespace App\Http\Controllers;

use App\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        return view('admin.settings.index', compact('setting'));
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'logo' => 'image',
            'icon' => 'image',
            'about' => 'image'
        ]);

        $setting = Setting::findOrFail($id);

        if ($logo = $request->file('logo'))
        {
            $logo_new_name = time() . $logo->getClientOriginalName();
            $logo->move('uploads/settings', $logo_new_name);
            $setting->logo = 'uploads/settings/' . $logo_new_name;
        }

        if ($icon = $request->file('icon'))
        {
            $icon_new_name = time() . $icon->getClientOriginalName();
            $icon->move('uploads/settings', $icon_new_name);
            $setting->icon = 'uploads/settings/' . $icon_new_name;
        }

        if ($about_image = $request->file('about_image'))
        {
            $about_image_new_name = time() . $logo->getClientOriginalName();
            $about_image->move('uploads/settings', $about_image_new_name);
            $setting->about_image = 'uploads/settings/' . $about_image_new_name;
        }


        $setting->update($request->except('logo', 'icon', 'about_image'));
        Session::flash('info', 'تم تحديث الاعدادات بنجاح');
        return redirect()->route('settings.index');
    }
}
