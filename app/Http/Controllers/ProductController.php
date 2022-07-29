<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $name=$request->input('name');
        $class=$request->input('class');
        $status=$request->input('status');

        if($request==null){
            $products=Product::all(['id', 'name','status']);
        }
        else {
            $products=Product::orwhere('name',$name)->orwhere('class',$class)->orwhere('status',$status)->get(['id', 'name','status']);
        }

        return response()->json(['data'=>$products],200);

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
        $request->validate([
            'name'=>'required',
            'class'=>'required',
            'price'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);
        $product = new Product();

        $product->name = $request->input('name');
        $product->class = $request->input('class');
        $product->price = $request->input('price');
        $product->image = $request->input('image');
        $product->status = $request->input('status');

        $product->save();

          return response()->json( ['success'=>true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->with('variants:product_id,title,availableStock')->first(['id', 'name','class','price','image','status']);

        if($product){
            return response()->json( ['product'=>$product],200);
        }
        else{
            return response()->json( ['message'=>'Product is not found'],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'class'=>'required',
            'price'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);
        $product = Product::find($id);
        if($product){

            $product->name = $request->input('name');
            $product->class = $request->input('class');
            $product->price = $request->input('price');
            $product->image = $request->input('image');
            $product->status = $request->input('status');

            $product->update();

            return response()->json( ['success'=>true],200);
        }
        else{
            return response()->json( ['message'=>'Product is not found'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::find($id);
        if($product){

            $product->delete();

            return response()->json( ['success'=>true],200);
        }
        else{
            return response()->json( ['message'=>'Product is not found'],404);
        }
    }
}
