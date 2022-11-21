@extends('item/item-layout')

<?php

    foreach($users as $user){
        if($user->id == $order->rest_id){
            $bTitle = $user->name;
        }
    }
?>

@section('browserTitle')
{{$bTitle}}
@endsection

@section('title')
Order Bill
@endsection

@section('mainContent')
    
    <div class="row mx-0 pt-3 justify-content-start">
        <div class="col-4">Order No:</div>
        <div class="col-8">{{$order->order_id}}</div>
        <div class="col-4">Order Time:</div>
        <div class="col-8">{{$order->date_time}}</div>
        <div class="col-4">Table No:</div>
        <div class="col-8">{{$order->table_no}}</div>
    </div>

    <livewire:bill-status :order="$order"/>

    <div class="row text-center justify-content-center py-2">
        <div class="col-9 h2 my-0 pt-2 lead">Order Information</div>
    </div>

    <div class="row  mx-0 pb-2">
        <div class="col-6 p border-bottom">Item</div>
        <div class="col-3 p border-bottom px-0 text-center">Quantity</div>
        <div class="col-3 p border-bottom text-center">Price</div>
    </div>

    @foreach ($orderlines as $orderline)
        @if($order->order_id == $orderline->order_id)
        <div class="row justify-content-start align-items-center mx-0 pb-2" >
            <div class="col-6 ">{{$orderline->items->item_name}}</div>
            <div class="col-3 px-0 text-center">{{$orderline->item_qty}}</div> 
            <div class="col-1 text-end px-0 ">RM</div>
            <div class="col-2 text-end ps-0">{{ number_format(($orderline->orderline_price), 2) }}</div>
        </div>
        @endif
    @endforeach
    
    
    <div class="row mt-2 fs-5 mx-0 border-top border-bottom py-1 mb-3">
        <div class="col-6 ">Total Payment</div>
        <div class="col-3 text-end px-0 ">RM</div>
        <div class="col-3 text-end ps-0 ">{{number_format(($order->order_total), 2)}}</div>
    </div>
    
    <div class="row text-center justify-content-center py-2">
        <div class="col-12 h2 my-0 pt-2">THANK YOU</div>
        <div class="col-12 h5 my-0">FOR DINING WITH US!</div>
    </div>

    
    {{-- <div class="row text-center pt-3 justify-content-center " >
        <p class="small ">Lot G-3/1, Ground Floor, Wisma Manikar, Off Mile 2 1/2 Jalan Tuaran, Likas, 88400<br>Kota Kinabalu, Malaysia</p>
        <p class="small my-0">Sunday-Friday : 10:00 - 18:00</p>
    </div> --}}

@endsection