<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if($req->has('searchPro')){
            $search = $req->searchPro;
            $product = Product::where('product_name','like','%'.$search.'%')->
                                orwhere('brand','like','%'.$search.'%')->
                                orwhere('description','%'.$search.'%')->
                          orderBy('id','DESC')->paginate(5);
        }else{
            $product = Product::orderBy('id','asc')->paginate(5);
        }       
        return view('admin.product.index',['products'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req,[
            'product_name' => 'required|string|max:50',
            'prand' => 'required|string|max:20',
            'price' => 'required|min:1',
            'quantity' => 'required',
            'stock' => 'required',
            'description' =>'required|string|max:255',
        ]);
        $data = New Product();
        $data->product_name = $req->product_name;
        $data->brand = $req->prand;
        $data->price = $req->price;
        $data->quantity =$req->quantity;
        $data->alert_stock = $req->stock;
        $data->description= $req->description;
        $data->save();
        if($data){
            return back()->with(['success'=>'A User has been Saved!']);
        }else{
            return back()->with(['fail'=>'A User can not Save!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $proEdit = Product::find($id);
        return view('admin.product.update',['proEdit'=>$proEdit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req,$id)
    {
        $this->validate($req,[
            'product_name' => 'required|string|max:50',
            'prand' => 'required|string|max:20',
            'price' => 'required|min:1',
            'quantity' => 'required',
            'stock' => 'required',
            'description' =>'required|string|max:255',
        ]);

        $pro = Product::find($id);
        $pro->product_name = $req->product_name;
        $pro->brand = $req->prand;
        $pro->price = $req->price;
        $pro->quantity =$req->quantity;
        $pro->alert_stock = $req->stock;
        $pro->description= $req->description;
        $pro->save();
        if($pro){
            return back()->with(['success'=>'A User has been Update!']);
        }else{
            return back()->with(['fail'=>'A User can not Update!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro = Product::find($id);
        $pro->delete();
        if($pro){
            return back()->with(['success'=>'A product has been deleted!']);
        }else{
            return back()->with(['fail'=>'Can not delete!']);
        }
    }
}
