<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use App\Models\Orderline;
use Illuminate\Http\Request;

date_default_timezone_set("Asia/Singapore");

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $currentUrl = url()->current();

        if (str_contains($currentUrl, 'bill')) { 
            $orderlines = Orderline::all();
            $users = User::all();
            return view('order/order-bill', compact('order', 'orderlines', 'users'));
        } 
        else {
            return view('order/order-index');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        $categories = Category::all();
        $users = User::all();
        
        return view('order/order-create', compact('items', 'categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = Item::all();
        $order = new Order;
        
        $url_reverse = strrev(url()->previous());
        $rest_id = $url_reverse[7];
        $order->rest_id = $rest_id;
        $order->save();

        $data = $request->all();
        $qtyData = array();
        foreach($data as $key=>$value){
            if ($value != null && $value != 0 && $key != "_token"){
                array_push($qtyData, substr($key,8), $value);
            }
        };

        for($i = 0; $i < count($qtyData); $i+=2){
            $orderline = new Orderline;
            $index = $i;
            $ol_item_id = $qtyData[$index];
            $ol_item_qty = $qtyData[$index+1];

            foreach($items as $item){
                if ($item->item_id == $ol_item_id){
                    $ol_price = ($item->item_price) * $ol_item_qty;
                }
            }

            $orderline->item_id = $ol_item_id;
            $orderline->item_qty = $ol_item_qty;
            $orderline->orderline_price = $ol_price;
            $orderline->order_id = $order->order_id;
            
            $orderline->save();
        }
        $editUrl = 'order/'.($order->order_id).'/edit';
        return redirect($editUrl);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderlines = Orderline::all();
        $items = Item::all();
        $categories = Category::all();
        $users = User::all();

        //added v0.2
        $getPreviousUrlArr = session()->get('_previous');
        $getPreviousUrl = $getPreviousUrlArr['url'];
        if(str_contains($getPreviousUrl, 'bill')){
            return redirect('order/'.($order->order_id).'/bill');
        }
        //added v0.2
        
        return view('order/order-show', compact('order', 'orderlines', 'items', 'categories', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $orderlines = Orderline::all();
        $users = User::all();
        
        //added v0.2
        $getPreviousUrlArr = session()->get('_previous');
        $getPreviousUrl = $getPreviousUrlArr['url'];
        if(str_contains($getPreviousUrl, 'bill')){
            return redirect('order/'.($order->order_id).'/bill');
        }
        //added v0.2

        return view('order/order-edit', compact('order', 'orderlines', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $orderlines = Orderline::all();
        $data = $request->all();

        if(array_key_exists("table",$data)){
            $order->table_no = request('table');
            $order->save();
        }

        if(array_key_exists("order_total",$data)){
            $order->order_total = request('order_total');
            $order->save();
        }

        

        $qtyData = array();
        foreach($data as $key=>$value){
            if ((str_starts_with($key, 'qty-item')) && $value != null ){
                array_push($qtyData, substr($key,8), $value);
            }
        };

        for($i = 0; $i < count($qtyData); $i+=2){
            $index = $i;
            $ol_item_id = $qtyData[$index];
            $newQty = $qtyData[$index+1];

            
            $new = $orderlines->where('item_id', '=', $ol_item_id)->where('order_id', '=', $order->order_id)->first();
            if ($new === null && $newQty != 0) {
                $newOrderline = new Orderline;
                $newOrderline->item_id = $ol_item_id;
                $newOrderline->order_id = $order->order_id;
                $newOrderline->item_qty = $newQty;
                $newOrderline->save();

                $newOrderline->orderline_price = ($newOrderline->items->item_price) * $newQty;
                $newOrderline->save();

            }

            foreach($orderlines as $orderline){

                if($orderline->item_id == $ol_item_id && $orderline->item_qty != $newQty && $orderline->order_id == $order->order_id){
                    if($newQty == 0){
                        $orderline->delete();
                    } 
                    else {
                        $orderline->item_qty = $newQty;
                        $orderline->orderline_price = ($orderline->items->item_price) * $newQty;
                        $orderline->save();
                    }
                    
                }
            }
        }

        $editUrl = 'order/'.($order->order_id).'/edit';
        $showUrl = 'order/'.($order->order_id);
        $billUrl = 'order/'.($order->order_id).'/bill';

        if($request->submit == "show"){
            return redirect($showUrl);
        }
        else if ($request->submit == "edit"){
            return redirect($editUrl);
        }
        else if ($request->submit == "confirm"){
            $order->order_status = "pending";
            $order->date_time = date("Y.m.d H:i:s");
            $order->save();
            return redirect($billUrl);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


}
