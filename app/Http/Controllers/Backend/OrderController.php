<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Invoice::withCount('orders')->paginate(20);
        return view('backend.pages.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Invoice::where('id', $id)->with('orders')->firstOrFail();
        return view('backend.pages.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request){
        $order = Invoice::where('id', $request->id)->firstOrFail();
        Order::where('order_no', $order->order_no)->delete();

        $order->delete();
        return response(['error'=>false, 'message'=>'Order deleted successfully']);
    }

    public function status(Request $request){
        $update = $request->statu;
        $updateCheck = $update == "false" ? '0' : '1';
        Invoice::where('id', $request->id)->update(['status' => $updateCheck]);
        return response(['error'=>false, 'status'=>$update]);
    }
}
