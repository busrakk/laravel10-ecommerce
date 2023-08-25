<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class PageHomeController extends Controller
{
    public function index(){
        // $slider = Slider::where('status', '1')->get();
        $slider = Slider::where('status', '1')->first(); // tek veri gönderildiği zaman kullanılabilir

        $about = About::where("id",1)->first();
        return view('frontend.pages.index', compact('slider', 'about'));
    }
}
