<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $products = Product::where("status","1")->paginate(1);
        return view('frontend.pages.products', compact('products'));
    }

    public function saleproduct(){
        return view('frontend.pages.products');
    }

    public function productdetail($slug){
        // $product = Product::whereSlug($slug)->first();
        $product = Product::where("slug",$slug)->first();
        return view('frontend.pages.product', compact('product'));
    }

    public function cart(){
        return view('frontend.pages.cart');
    }
}
