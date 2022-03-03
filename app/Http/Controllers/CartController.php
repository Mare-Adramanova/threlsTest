<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product, $quantity)
    {
        
        $stock_qty = $product->quantity;
        $id = $product->id;
        $product->quantity = 1;
        $cart = Cache::get('cart');
        
        if(!$cart){
            $cart = [
                $id => [
                    "product_id"=> $product->id,
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product['price'],
                    "stock_qty"=> $stock_qty
                ]
        ];
        Cache::put('cart', $cart);
        return response()->json(Cache::get('cart'));
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] ++; 
            
            Cache::put('cart', $cart);
            
            return response()->json(Cache::get('cart'));
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart += [
            $id => [
                "product_id"=> $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product['price'],
                "stock_qty"=> $stock_qty
            ]
            ];
        Cache::put('cart', $cart);
        return response()->json(Cache::get('cart'));
        
    }

    public function update($id, Request $request)
        { 
            $cart = Cache::get('cart');
            
            $cart[$id]["quantity"] ++ ;
            Cache::put('cart', $cart);
            return response([
                'data' => Cache::get('cart'),
                'message' => "record updated"
            ]);
        }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $cart = Cache::get('cart');
         
        if(isset($cart[$id])) {
           
            --$cart[$id]["quantity"];
            if($cart[$id]["quantity"] < 1){
                
                $cart[$id] = false; 
                unset($cart[$id]);
                
            } 
            Cache::put('cart', $cart);
        }
        return response()->json('Product removed successfully');
        
    }
}
