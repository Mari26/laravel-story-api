<?php

namespace App\Http\Controllers\API;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
           'provider_id' => 'required',
           'type_id' => 'required',
           'name' => 'required',
           'code' => 'required',
           'price' => 'required',
           'productiontime' => 'required',
           'productionperiod' => 'required',
       ]);
       $newProduct= new Product([
           'provider_id' => $request->get('provider_id'),
           'type_id' => $request->get('type_id'),
           'name' => $request->get('name'),
           'code' => $request->get('code') ,
           'price' =>$request->get('price') ,
           'productiontime' => $request->get('productiontime') ,
           'productionperiod' => $request->get('productionperiod') ,
       ]);
        $newProduct->save();
        return response()->json($newProduct);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::findOrfail($id);
        return response()->json($product);
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
        $product=Product::findOrfail($id);
        $request->validate([
            'provider_id' => 'required',
            'type_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'productiontime' => 'required',
            'productionperiod' => 'required',
        ]);

            $product->provider_id = $request->get('provider_id');
            $product->type_id =$request->get('type_id');
            $product->name =$request->get('name');
            $product->code =$request->get('code') ;
            $product-> price =$request->get('price') ;
            $product->productiontime =$request->get('productiontime') ;
            $product->productionperiod =$request->get('productionperiod');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrfail($id);
        $product->delete();
        return response()->json($product::all());
    }
}
