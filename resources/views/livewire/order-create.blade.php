<div class="row justify-content-center mx-0 pb-2">
    <div class="col-2 px-0 btn-group">
        <button type="button" class="btn btn-primary btn-sm fw-bold" wire:click="decrement" style="border-radius: 8px 0 0 8px;">-</button>
    </div> 
    <div class="col-4 px-0">
        <input type="number" class="form-control input-md text-center rounded-0" readonly 
        id="qty-item{{$item_id}}" name="qty-item{{$item_id}}" 
        value="{{$count}}">
    </div>
    <div class="col-2 px-0 btn-group" >
        <button type="button" class="btn btn-primary btn-sm fw-bold" wire:click="increment" style="border-radius: 0 8px 8px 0;">+</button>
    </div> 
</div>

