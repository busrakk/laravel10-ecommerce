<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
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

        if(session()->get('couponCode')){
            $coupon = Coupon::where('name', session()->get('couponCode'))->where('status', '1')->first();
            $couponPrice = $coupon->price ?? 0;
            $couponCode = $coupon->name ?? '';

            $totalPrice -= $couponPrice;
        }else{
            $totalPrice = $totalPrice;
        }

        session()->put('totalPrice', $totalPrice);

        //return $cartItem;
        return view('frontend.pages.cart', compact('cartItem'));
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
            $cartItem[$productID]['qty'] += $qty; // adet ekleme
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

        if($request->ajax()){
            return response()->json(['Cart updated successfully']);
        }

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

    public function couponcheck(Request $request){
        $cartItem = session('cart', []);
        $totalPrice = 0;

        foreach($cartItem as $cart){
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        $coupon = Coupon::where('name', $request->coupon_name)->where('status', '1')->first();
        $couponPrice = $coupon->price ?? 0;
        $couponCode = $coupon->name ?? '';

        $totalPrice -= $couponPrice;

        session()->put('totalPrice', $totalPrice);
        session()->put('couponCode', $couponCode);

        if(empty($coupon)){
            return back()->withError('Coupon not found.');
        }

        return back()->withSuccess('Coupon applied successfully.');
    }

    public function newQty(Request $request){
        $productID= $request->product_id;
        $qty= $request->qty ?? 1;
        $itemTotal = 0;

        $product = Product::find($productID);
        if(!$product) {
            return response()->json('Product not found!');
        }
        $cartItem = session('cart',[]);


        if(array_key_exists($productID,$cartItem)){
            $cartItem[$productID]['qty'] = $qty; // adet güncelleme
            if($qty == 0 || $qty < 0){
                unset($cartItem[$productID]);
            }
            $itemTotal = $product->price * $qty;
        }

        session(['cart'=>$cartItem]);

        if($request->ajax()) {
            return response()->json(['itemTotal' => $itemTotal, 'message' => 'Cart updated successfully']);
        }
    }
}
