<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Product;

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

        $product =auth()->user()->product;
        return response()->json([
            "success" => true,
            "message" => "Product List",
            "data" => $product
        ]);
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
        $this->validate($request, [
            'provider_id' =>'required',
            'type_id' =>'required',
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'productiontime' => 'required',
            'productionperiod' => 'required',
        ]);

        $product = new Product();
        $product->provider_id = $request->provider_id ;
        $product->type_id = $request->type_id;
        $product->name = $request->name ;
        $product->code = $request->code;
        $product->price = $request->price ;
        $product->productiontime = $request->productiontime;
        $product->productionperiod = $request->productionperiod ;


        if (auth()->user()->product()->save($product))
            return response()->json([
                'success' => true,
                'data' => $product->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'product could not be added!'
            ], 500);





    }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
    {
        $product = auth()->user()->product()->find($id);

        if (!($product)) {
            return response()->json([
                'success' => false,
                'message' => 'product is not available! '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $product->toArray()
        ], 400);
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
        $product = auth()->user()->product()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'product could not be found!'
            ], 400);
        }

        $updated = $product->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'product could not be updated!'
            ], 500);
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
    {
        $product = auth()->user()->product()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'product could not be found!'
            ], 400);
        }

        if ($product->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'product could not be deleted!'
            ], 500);
        }
    }
    }
