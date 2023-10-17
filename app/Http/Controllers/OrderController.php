<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    public function create(Request $request){


        $data=[
            'customer_name'=>$request->name,
            'deliver_address'=>$request->address,
            'total_price'=>$request->total_price,
        ];
       $order = Order::create($data);
        if($order){
            $order_id=$order->id;
            $products = json_decode($request->products);
            if(count($products)>0){
                foreach($products as $product_id){
                    OrderProduct::create([
                        'order_id'=>$order_id,
                        'product_id'=>$product_id,
                    ]);
                }
            }

        }
        $orders = Order::with('order_products')->where('id',$order->id)->first();
        return response()->json($orders);
    }
}
