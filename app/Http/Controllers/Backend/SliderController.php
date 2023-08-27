<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

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
}
