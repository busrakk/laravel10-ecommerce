<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cartItem = session('cart', []);
        $totalPrice = 0;

        foreach($cartItem as $cart){
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        //return $cartItem;
        return view('frontend.pages.cart', compact('cartItem', 'totalPrice'));
    }

    public function add(Request $request){
        $productID = $request->product_id;
        $qty = $request->qty ?? 1;
        $size = $request->size;

        $product = Product::find($productID);

        if(!$product){
            return back()->withError('Product Not Found.');
        }

        $cartItem = session('cart', []);

        if(array_key_exists($productID, $cartItem)){
            $cartItem[$productID]['qty'] += $qty;
        }else{
            $cartItem[$productID]=[
                'image' => $product->image,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'size' => $size
            ];
        }

        session(['cart' => $cartItem]);

        return back()->withSuccess('Product successfully added to cart.');
    }

    public function remove(Request $request){
        // return $request->all();

        $productID = $request->product_id;
        $cartItem = session('cart', []);

        if(array_key_exists($productID, $cartItem)){
            unset($cartItem[$productID]);
        }

        session(['cart' => $cartItem]);

        return back()->withSuccess('The product has been successfully deleted from the cart.');
    }
}
