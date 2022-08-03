<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function create(Request $request)
    {
        $product_id = $request->id;
        $cart = Cart::create([
            'quantity' => 1,
        ]);
        $cart->products()->attach($product_id, ['quantity' => 1]);
        return response()->json($cart);
    }
    public function update(Request $request)
    {
        $product_id = $request[1]['id'];
        $cart_id = $request[0];

        $cart = Cart::find($cart_id);
        $cart->quantity = $cart->quantity + 1;

        $cart_product = CartProduct::where('cart_id', '=', $cart_id)->where('product_id', '=', $product_id)->first();
        if ($cart_product) {
            $quantity = $cart_product->quantity + 1;
            DB::table('cart_product')->where('cart_id', '=', $cart_id)->where('product_id', '=', $product_id)
                ->update(['quantity' => $quantity]);
        } else {
            $cart->products()->attach($product_id, ['quantity' => 1]);
        }

        $cart->save();

        return response()->json($cart);
    }
    public function show($id)
    {
        $cart = Cart::find(1);
        return response()->json($cart);
    }
    public function index()
    {
        $cart = Cart::all();
        return response()->json($cart);
    }
    public function remove(Request $request)
    {
        $product_id = $request[1]['id'];
        $cart_id = $request[0];
        $cart = Cart::find($cart_id);

        $cart_product = CartProduct::where('cart_id', '=', $cart_id)->where('product_id', '=', $product_id)->first();

        if ($cart_product) {
            $quantity = $cart_product->quantity - 1;
            DB::table('cart_product')->where('cart_id', '=', $cart_id)->where('product_id', '=', $product_id)
                ->update(['quantity' => $quantity]);
            $cartQuantity = $cart->quantity - 1;
            $cart->update(['quantity' => $cartQuantity]);
            $cart->save();
            $cart_product->save();
        }
        if ($cart_product->quantity == 1) {
            $cart_product->delete();
        }

        return response()->json(['message' => 'One item has been deleted from cart']);
    }
    public function getProducts($id){
    $cart=Cart::find($id);
    $cart->products;
    return response()->json($cart);

    }
    public function destroy($id){
        $cart=Cart::find($id);
        $cart->products()->detach();
        $cart->quantity=0;
        $cart->save();
        return response()->json(['message' => 'cart has been clened']);

    }
}
