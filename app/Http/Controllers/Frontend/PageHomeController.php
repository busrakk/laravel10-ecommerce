<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageHomeController extends Controller
{
    public function index(){
        // $slider = Slider::where('status', '1')->get();
        $slider = Slider::where('status', '1')->first(); // tek veri gönderildiği zaman kullanılabilir

        $about = About::where("id",1)->first();

        $lastProducts = Product::where('status','1')
         ->select(['id','name','slug','size','color','price','category_id','image'])
         ->with('category')
         ->orderBy('id','desc')
         ->limit(10)
         ->get();

        return view('frontend.pages.index', compact('slider', 'about', 'lastProducts'));
    }
}
