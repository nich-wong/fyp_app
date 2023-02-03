
<div wire:poll>
@if($order->order_status != "cancelled" && $order->order_status != null)
@if($status != "served" || $status_payment == "false" || $status_payment == null )
<div class="row mx-0 py-2">
 
    <div class="row mx-0 pt-1 justify-content-start px-0">
        <div class="col-4">Order No:</div>
        <div class="col-7">{{$order->order_id}}</div>

        <div class="col-1 px-0">
            <button type="button" class="btn-close" wire:click="click_cancel_btn"></button>
        </div>

        {{-- <!-- Code for confirmation to cancel, but modal doesnt work while polling -->
            <!-- Button trigger modal -->
            <div class="col-1 px-0">
                <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$order->order_id}}"></button>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop{{$order->order_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Confirm to cancel Order No. {{$order->order_id}}
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Confirm Cancel</button>
                    </div>
                </div>
                </div>
            </div> 
        --}}
        
        <div class="col-4">Order Time:</div>
        <div class="col-8">{{$order->date_time}}</div>
        {{-- <div class="col-4">Table No:</div>
        <div class="col-8">{{$order->table_no}}</div> --}}
    </div>

    <div class="row mx-0 py-2 fw-semibold px-0">
        <div class="col-2 p border-bottom  text-center">Qty</div>
        <div class="col-7 p border-bottom ">Item</div>
        <div class="col-3 p border-bottom text-center">Price</div>
    </div>

    @foreach ($orderlines as $orderline)
        @if($order->order_id == $orderline->order_id)
        <div class="row justify-content-start align-items-center mx-0 px-0 pb-2">
            <div class="col-2 px-0 text-center">x {{$orderline->item_qty}}</div>
            <div class="col-7 ">{{$orderline->items->item_name}}</div>
            <div class="col-1 text-end px-0 ">RM</div>
            <div class="col-2 text-end ps-0">{{number_format(($orderline->orderline_price), 2)}}</div>
        </div>
        @endif
    @endforeach
    
    <div class="row justify-content-start align-items-center mx-0 px-0 pb-2 fw-semibold">
        <div class="col-9 ">Total Payment</div>
        <div class="col-1  text-end px-0 ">RM</div>
        <div class="col-2  text-end ps-0 ">{{number_format(($order->order_total), 2)}}</div>
    </div>
    
    {{-- BUTTONS --}}
    <div class="col px-0 btn-group">
        @if($status == "preparing")
        <input type="radio" class="btn-check" name="status-group-{{$order->order_id}}" id="preparing-btn-{{$order->order_id}}" autocomplete="off" checked>
        <label class="btn btn-outline-warning " wire:click="click_prep_btn" style="border-radius: 8px 0 0 8px;" for="preparing-btn-{{$order->order_id}}">Preparing</label>
        @else
        <input type="radio" class="btn-check" name="status-group-{{$order->order_id}}" id="preparing-btn-{{$order->order_id}}" autocomplete="off">
        <label class="btn btn-outline-warning " wire:click="click_prep_btn" style="border-radius: 8px 0 0 8px;" for="preparing-btn-{{$order->order_id}}">Preparing</label>
        @endif
    </div>
    <div class="col px-0 btn-group">
        @if($status == "ready")
        <input type="radio" class="btn-check" name="status-group-{{$order->order_id}}" id="ready-btn-{{$order->order_id}}" autocomplete="off" checked>
        <label class="btn btn-outline-success rounded-0" wire:click="click_ready_btn" for="ready-btn-{{$order->order_id}}">Ready</label>
        @else
        <input type="radio" class="btn-check" name="status-group-{{$order->order_id}}" id="ready-btn-{{$order->order_id}}" autocomplete="off">
        <label class="btn btn-outline-success rounded-0" wire:click="click_ready_btn" for="ready-btn-{{$order->order_id}}">Ready</label>
        @endif
    </div>
    <div class="col px-0 btn-group">
        @if($status == "served")
        <input type="radio" class="btn-check" name="status-group-{{$order->order_id}}" id="served-btn-{{$order->order_id}}" autocomplete="off" checked>
        <label class="btn btn-outline-primary " wire:click="click_served_btn" style="border-radius: 0 8px 8px 0;" for="served-btn-{{$order->order_id}}">Served</label>
        @else
        <input type="radio" class="btn-check" name="status-group-{{$order->order_id}}" id="served-btn-{{$order->order_id}}" autocomplete="off">
        <label class="btn btn-outline-primary " wire:click="click_served_btn" style="border-radius: 0 8px 8px 0;" for="served-btn-{{$order->order_id}}">Served</label>
        @endif
    </div>

    <div class="col-12 px-0 py-2 btn-group" >
        @if($payment == "false" || $payment == null)
            @if($count % 2 == 0)
                <button type="button" class="btn btn-danger" wire:click="click_payment_false"
                    name="payment-btn-{{$order->order_id}}" id="payment-btn-{{$order->order_id}}" >
                    Payment Not Made</button>
            @elseif($count % 2 == 1)
                <button type="button" class="btn btn-primary" wire:click="click_payment_false"
                    name="payment-btn-{{$order->order_id}}" id="payment-btn-{{$order->order_id}}" >
                    Payment Made</button>
            @endif

        @elseif($payment == "true")
            @if($count % 2 == 0)
                <button type="button" class="btn btn-primary" wire:click="click_payment_true"
                    name="payment-btn-{{$order->order_id}}" id="payment-btn-{{$order->order_id}}" >
                    Payment Made</button>
            @elseif($count % 2 == 1)
                <button type="button" class="btn btn-danger" wire:click="click_payment_true"
                    name="payment-btn-{{$order->order_id}}" id="payment-btn-{{$order->order_id}}" >
                    Payment Not Made</button>
            @endif
        @endif
    </div>
    
    <div class="border-bottom border-danger"></div>
    

</div>
@endif
@endif
</div>


    
