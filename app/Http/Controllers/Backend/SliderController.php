<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use ImageResize;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view('backend.pages.slider.index', compact('sliders'));
    }

    public function create(){
        return view('backend.pages.slider.create');
    }

    public function edit($id){
        $slider = Slider::where('id', $id)->first();
        return view('backend.pages.slider.edit', compact('slider'));
    }

    public function store(SliderRequest $request){

        $uploadFolder = 'img/slider/';
        if (!file_exists(public_path($uploadFolder))) {
            mkdir(public_path($uploadFolder), 0777, true); // Dizini oluştur ve izinleri ayarla
        }

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $extension = $img->getClientOriginalExtension();
            $folderName = time() . '-' . Str::slug($request->name);
            //$uploadFolder = 'img/slider/';

            if (in_array($extension, ['pdf', 'svg', 'webp'])) { // Dosya uzantısına göre işlemler
                $img->move(public_path($uploadFolder), $folderName . '.' . $extension);
            } else {
                $img = ImageResize::make($img);
                $img->encode('webp', 75)->save(public_path($uploadFolder . $folderName . '.webp'));
            }
        }

        Slider::create([
            'name' => $request->name,
            'content' => $request->content,
            'link' => $request->link,
            'status' => $request->status,
            'image' => $folderName ?? NULL,
        ]);

        return back()->withSuccess('Slider created successfully');
        // return $request->all();
    }
}
