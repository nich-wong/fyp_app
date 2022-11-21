
<div class="row justify-content-start align-items-center mx-0 pb-2">
    <div class="col-6 ">{{$orderline_item_name}}</div>
    <div class="col-1 px-0 btn-group ">
        <button type="button" class="btn btn-danger btn-sm " wire:click="decrement" style="border-radius: 8px 0 0 8px;" >-</button>
    </div> 
    <div class="col-1 px-0">
        <input type="number" class="form-control input-md text-center rounded-0 py-1 px-0" style="border: 0;" readonly
        id="qty-item{{$orderline_item_id}}" name="qty-item{{$orderline_item_id}}" 
        value="{{$count}}">
    </div> 
    <div class="col-1 px-0 btn-group ">
        <button type="button" class="btn btn-success btn-sm" wire:click="increment" style="border-radius: 0 8px 8px 0;" >+</button>
    </div>

    <div class="col-1 text-end px-0 ">RM</div>
    <div class="col-2 text-end ps-0">{{ number_format(($ol_price), 2) }}</div>

</div>



