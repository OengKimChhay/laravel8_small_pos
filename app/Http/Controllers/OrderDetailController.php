<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Order_Detail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $transaction = Transaction::all();
        $lastId = Order_Detail::max('customer_id');
        $pro_receipt = Order_Detail::where('customer_id',$lastId)->get();
        return view('admin.orderDetail.index',['products'=>$products,'pro_receipt'=>$pro_receipt,'transaction'=>$transaction]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product_id' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'discount' => 'nullable',
            'total' => 'required',
            'customer_name' => 'required',
            'costomer_phone' => 'nullable',
            'method' => 'required',
            'payment' => 'required',
            'change' => 'nullable',
        ]);
        // save for customer
            $customer = new Customer;
            $customer->costomer_name = $request->customer_name;
            $customer->costomer_phone = $request->customer_phone;
            $customer->save();
            $customerId = $customer->id;

        // save for order
        if(count($request->product_id)>0){
            for($i=0;$i<count($request->product_id);$i++){
                $Order = new Order_Detail;
                $Order->customer_id = $customerId;
                $Order->product_id = $request->product_id[$i];
                $Order->quantity = $request->quantity[$i];
                $Order->unitprice = $request->price[$i];
                $Order->amount = $request->total[$i];
                $Order->discount = $request->discount[$i];
                $Order->save();
            };
        }
    
        // for transaction
        $tran = new Transaction;
        $tran->customer_id = $customerId;
        $tran->user_id = auth()->user()->id;
        $tran->paid_amount = $request->amount;
        $tran->balance = $request->payment;  
        $tran->payment_method = $request->method; 
        $tran->save();

        return back()->with('success','Your order is Reach!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order_Detail  $order_Detail
     * @return \Illuminate\Http\Response
     */
    public function show(Order_Detail $order_Detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order_Detail  $order_Detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Order_Detail $order_Detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order_Detail  $order_Detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_Detail $order_Detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order_Detail  $order_Detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_Detail $order_Detail)
    {
        //
    }
}
