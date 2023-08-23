<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contact(){
        return view('frontend.pages.contact');
    }

    public function about(){
        $about = About::where("id",1)->first();
        return view('frontend.pages.about', compact("about"));
    }

    public function product(){
        return view('frontend.pages.products');
    }

    public function saleproduct(){
        return view('frontend.pages.products');
    }

    public function productdetail(){
        return view('frontend.pages.product');
    }

    public function cart(){
        return view('frontend.pages.cart');
    }
}
