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
Order Details
@endsection

@section('mainContent')
    

    <form method="post" 
    action="/order/{{$order->order_id}}"
    >
		@csrf
        @method('put')

        <div class="div py-2 form-group">
            <button class="btn btn-primary btn-sm" name="submit" value="show">Back To Menu</button>
        </div>
 
        {{-- <div class="row justify-content-start">
            <div class="col-4 p">Order No:</div>
            <div class="col-8 p">{{$order->order_id}}</div>
            <div class="col-4 p">Order Time:</div>
            <div class="col-8 p">{{$order->date_time}}</div>
        </div> --}}
       
        {{-- <div class="row">
			<label class="col-6 control-label pe-0 align-self-center text-end" for="table">Enter Table No:</label>  
			<div class="col-2 pe-0">
                @if($order->table_no == null)
				    <input id="table" name="table" type="number" placeholder="-" class="form-control text-center px-1">
                @else
                    <input id="table" name="table" type="number" value="{{$order->table_no}}" class="form-control text-center px-1">
                @endif
			</div>
		</div> --}}

        <div class="row text-center justify-content-center py-2">
            <div class="col-9 h2 my-0 pt-2">Order Items</div>
        </div>

        <div class="row  mx-0 pb-2">
            <div class="col-6 p border-bottom">Item</div>
            <div class="col-3 p border-bottom px-0 text-center">Quantity</div>
            <div class="col-3 p border-bottom text-center">Price</div>
        </div>

        <?php 
            $total_price = 0;
            $item_count_total = 0; 
        ?>
        @foreach ($orderlines as $orderline)
        @if($order->order_id == $orderline->order_id)
            <?php
                $total_price += $orderline->orderline_price; 
                $item_count_total += $orderline->item_qty;
            ?>
            <livewire:order-edit :orderline="$orderline"/>
        @endif
        @endforeach
        
        <livewire:order-edit-total :total_price="$total_price"/>
        
        
        {{-- <div class="row justify-content-center fixed-bottom mb-3">
            <div class="col-8 btn-group">
                <button class="btn btn-primary btn-lg" name="submit" value="confirm">Confirm Order</button>
            </div>
        </div> --}}

        <!-- Button trigger modal -->
        <div class="row justify-content-center fixed-bottom mb-3">
            <div class="col-8 btn-group">
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Confirm Order
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Order Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your order will be sent to our kitchen. <br> Confirm?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <button name="submit" value="confirm" class="btn btn-success">Confirm Order</button>
                </div>
            </div>
            </div>
        </div>

    </form>

    <footer>
        <div class="container py-3"></div>
    </footer>

    <livewire:alert-count :item_count_total="$item_count_total"/>


@endsection