<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    //
    public function show($id)
    {
        $cart = CartProduct::where('cart_id', $id)->get();
        return response()->json($cart);
    }
}
