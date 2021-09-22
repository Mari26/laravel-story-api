<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        $products = Product::all();
        return ProductResource::collection($products);
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
        public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create($validated);

        return ProductResource::collection($product);

    }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        return ProductResource::collection($product);
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
        public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        if($validated->fails()){
            return $this->sendError('Validation Error.', $validated->errors());
        }
        $product->provider_id = $validated['provider_id'];
        $product->type_id = $validated['type_id'];
        $product->name = $validated['name'];
        $product->code = $validated['code'];
        $product->price = $validated['price'];
        $product->productiontime = $validated['productiontime'];
        $product->productionperiod = $validated['productionperiod'];
        $product->save();
        return ProductResource::collection($product);
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Product $product)
        {
            $product->delete();
            return response()->json(null, 204);
        }
}
