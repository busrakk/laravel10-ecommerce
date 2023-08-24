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

    public function product(Request $request){
        // if(!empty($request->size)){
        //     $size = $request->size;
        // }else{
        //     $size = null;
        // }

        $size = $request->size ?? null;
        $color = $request->color ?? null;
        $start_price = $request->start_price ?? null;
        $end_price = $request->end_price ?? null;

        $products = Product::where("status","1")
        ->where(function($q) use($size, $color, $start_price, $end_price){
            if(!empty($size)){
                $q->where('size', $size);
            }
            if(!empty($color)){
                $q->where('color', $color);
            }
            if(!empty($start_price) && $end_price){
                $q->where('price', [$start_price, $end_price]);
            }
            return $q;
        })
        ->paginate(1);
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
