<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $settings = SiteSetting::get();
        return view('backend.pages.setting.index', compact('settings'));
    }

    public function create(){
        return view('backend.pages.setting.edit');
    }

    public function store(Request $request){
        $key = $request->name;
            SiteSetting::firstOrCreate(
                [
                 'name' => $key,
                ],[
                 'name' => $key,
                 'data' => $request->data,
                 'set_type' => $request->set_type
                ]
        );

        return back()->withSuccess('Setting created successfully');
    }

    public function edit($id){
        $setting = SiteSetting::where('id', $id)->first();
        return view('backend.pages.setting.edit', compact('setting'));
    }

    public function update(Request $request, $id){
        $setting = SiteSetting::where('id', $id)->first();

        $key = $request->name;

        if ($request->hasFile('data')) {
            dosyasil($setting->data);

            $img = $request->file('data');
            $folderName = $key;
            $uploadFolder = 'img/setting/';
            folderOpen($uploadFolder);
            $imgurl = resimyukle($img, $folderName, $uploadFolder);
        }

            $setting->update(
                [
                 'name' => $key,
                 'data' => $imgurl ?? $request->data,
                 'set_type' => $request->set_type
                ]
        );

        return back()->withSuccess('Setting updated successfully');
    }
}
