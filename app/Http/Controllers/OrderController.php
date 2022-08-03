<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProducts;
use DateTime;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function create(Request $request)
    {

        $order = Order::create([
            'name' => $request->shipping['name'],
            'address' => $request->shipping['address'],
            'city' => $request->shipping['city'],
        ]);

        $items = [];
        foreach ($request->items as $item) {
            $orderProduct=new OrderProducts();
            $orderProduct->order_id=$order->id;
            $orderProduct->title=$item['product']['title'];
            $orderProduct->price=$item['product']['price'];
            $orderProduct->quantity=$item['product']['quantity'];
            $orderProduct->totalPrice=$item['product']['totalPrice'];
            $orderProduct->imageUrl=$item['product']['imageUrl'];
            $orderProduct->save();

            array_push($items,$item);
        }

        return response()->json($order);
    }
}
