<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cartItem = session('cart', []);
        $totalPrice = 0;

        foreach($cartItem as $cart){
            $kdvOrani = $cart['kdv'] ?? 0;
            $kdvTutar = ($cart['price'] * $cart['qty']) * ($kdvOrani / 100);
            $toplamTutar = $cart['price'] * $cart['qty'] + $kdvTutar;
            $totalPrice += $toplamTutar;
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
                'kdv' => $product->kdv,
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
        session()->put('couponPrice', $couponPrice);

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
            // $itemTotal = $product->price * $qty;
            $kdvOraniItem = $product->kdv ?? 0;
            $kdvTutarItem = ($product->price * $qty) * ($kdvOraniItem / 100);
            $itemTotal = $product->price * $qty + $kdvTutarItem;
        }

        session(['cart'=>$cartItem]);

        $cartItem = session('cart');
        $totalPrice = 0;

        if(session()->get('couponCode')){
            $coupon = Coupon::where('name', session()->get('couponCode'))->where('status', '1')->first();
            $couponPrice = $coupon->price ?? 0;

            $totalPrice -= $couponPrice;
        }else{
            $totalPrice = $totalPrice;
        }

        foreach($cartItem as $cart){
            $kdvOrani = $cart['kdv'] ?? 0;
            $kdvTutar = ($cart['price'] * $cart['qty']) * ($kdvOrani / 100);
            $toplamTutar = $cart['price'] * $cart['qty'] + $kdvTutar;
            $totalPrice += $toplamTutar;
        }
        session()->put('totalPrice', $totalPrice);

        if($request->ajax()) {
            return response()->json(['itemTotal' => $itemTotal, 'totalPrice' => session()->get('totalPrice'), 'message' => 'Cart updated successfully']);
        }
    }

    public function cartform(){
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
        return view('frontend.pages.cartform', compact('cartItem'));
    }

    function generateKod() {
        $siparisno = generateOTP(7);
            if ($this->barcodeKodExists($siparisno)) {
                return $this->generateKod();
            }

            return $siparisno;
        }

        function barcodeKodExists($siparisno) {
            return Invoice::where('order_no',$siparisno)->exists();
        }

    public function cartSave(Request $request){
        // return $request->all();

        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string',
            'company_name' => 'nullable|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'zip_code' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $invoce = Invoice::create([
            "user_id"=> auth()->user()->id ?? null,
            "order_no"=> $this->generateKod(),
            "country"=> $request->country,
            "name"=> $request->name,
            "company_name"=> $request->company_name ?? null,
            "address"=> $request->address ?? null,
            "city"=> $request->city ?? null,
            "district"=> $request->district ?? null,
            "zip_code"=> $request->zip_code ?? null,
            "email"=> $request->email ?? null,
            "phone"=> $request->phone ?? null,
            "note"=> $request->note ?? null,
        ]);

        $cart = session()->get('cart') ?? [];
            foreach ( $cart as $key => $item) {
                Order::create([
                    'order_no'=> $invoce->order_no,
                    'product_id'=>$key,
                    'name'=>$item['name'],
                    'price'=>$item['price'],
                    'qty'=>$item['qty'],
                    'kdvd'=>$item['kdv'],
                ]);
            }

            session()->forget('cart');
            return redirect()->route('index')->withSuccess('Shopping Completed Successfully.');
    }
}
