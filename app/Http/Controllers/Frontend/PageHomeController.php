<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class PageHomeController extends Controller
{
    public function index(){
        // $slider = Slider::where('status', '1')->get();
        $slider = Slider::where('status', '1')->first(); // tek veri gönderildiği zaman kullanılabilir
        $title = 'HOME';
        return view('frontend.pages.index', compact('slider', 'title'));
    }
}
