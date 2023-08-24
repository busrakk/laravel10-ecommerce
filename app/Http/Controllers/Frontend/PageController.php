<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

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
        ->select(['id','name', 'slug', 'size', 'color', 'price', 'category_id', 'image'])
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
        ->with('category:id,name,slug');

        // tablodaki min ve max fiyatı çekme
        $minPrice = $products->min('price');
        $maxPrice = $products->max('price');

        $sizeLists = Product::where("status","1")->groupBy('size')->pluck('size')->toArray();

        $colors = Product::where("status","1")->groupBy('color')->pluck('color')->toArray();

        $products = $products->paginate(1);

        // ilişki kurulduğu için with kullanıldı
        // sasdece sayısını istersek withCount kullanılır
        $categories = Category::where('status','1')->where('cat_ust', null)->withCount('items')->get();

        return view('frontend.pages.products', compact('products','categories' , 'minPrice','maxPrice', 'sizeLists', 'colors'));
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
