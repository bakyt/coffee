<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\OrderItem;
use App\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Order::all()->where('waiter_id', \request('waiter_id'))->toArray(), 200);
    }

    /**orders
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'waiter_id'=>$request->waiter_id,
            'table_id'=>$request->table_id
        ]);
        if(!$order) return response()->json("server_error");
        $total = 0;
        $foods = Food::all();
        foreach ($request->foods as $value){
            $tota=$foods->where('id', $value['id'])->first()->price*$value['quantity'];
            OrderItem::create([
                'food_id'=>$value['id'],
                'order_id'=>$order->id,
                'quantity'=>$value['quantity'],
                'total'=>$tota
            ]);
            $total+=$tota;
        }
        $order->update(['total'=>$total]);
        return response()->json($order, 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json(OrderItem::all()->where('order_id', $order->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $total=0;
        $foods = Food::all();
        foreach ($request->foods as $value){
            $tota=$foods->where('id', $value['id'])->first()->price*$value['quantity'];
            OrderItem::create([
                'food_id'=>$value['id'],
                'order_id'=>$order->id,
                'quantity'=>$value['quantity'],
                'total'=>$tota
            ]);
            $total+=$tota;
        }
        $order->update([
            'total'=>$total+$order->total
        ]);
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order$order->id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->update(['isOpen'=>0]);
        return response()->json('Order was closed', 200);
    }
}
