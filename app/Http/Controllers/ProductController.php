<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return  ProductCollection::collection($product);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        
        $product->save();
        return response([
            'data' => new ProductResource($product),
            "message" => "records created"
        ]);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       return new ProductResource($product);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        $product->name = is_null($request->name) ? $product->name : $request->name;
        $product->price = is_null($request->price) ? $product->price : $request->price;
        $product->description = is_null($request->description) ? $product->description : $request->description;
        $product->quantity = is_null($request->quantity) ? $product->quantity : $request->quantity;
       
        $product->save();

        return response([
            'data' => new ProductResource($product),
            'message' => "records updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->exists()){
            $product->delete();
            return response()->json([
                "message" => "records deleted"
            ], 202);
        }
        return response()->json([
            "message" => "records not found"
        ], 404);
    
    }
}
