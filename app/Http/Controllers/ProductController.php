<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Mail\NewUserNotification;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
      $products = Product::all();

      return ProductResource::collection($products);
     }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */

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

    public  function buy(Product $product, Customer $customer, Request $request)
    {
        try {
            $totalPrice = $request->quantity * $product->price;
            if($totalPrice <= $customer->money && $request->quantity <= $product->quantity) {
                $customer->money -= $totalPrice;
                $product->quantity -= $request->quantity;
                $customer->save();
                $product->save();
                Transaction::create([
                    'product_id' => $product->id,
                    'user_id' => Auth::id(),
                    'customer_id' => $customer->id,
                    'product_price' => $product->price,
//                    'quantity' => $request->quantity
                ]);
                Mail::to(Auth::user()->email)->send(new NewUserNotification($customer));

                return true;
            }
            return response()->json(['message' => 'You do not have enough money in your account']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}

