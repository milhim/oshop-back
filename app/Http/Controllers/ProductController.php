<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function create(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product);
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        $product->save();
        return response()->json($product);
    }
    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json(['Delete product done!'],200);

    }
}
