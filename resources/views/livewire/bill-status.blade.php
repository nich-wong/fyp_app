<div class="row text-center justify-content-center py-2" wire:poll>
    <div class="col-12 h2 my-0 lead">Order Status:</div>

    @switch($order_status)
    @case("pending")
        <div class="col-12 h5 my-0 text-danger">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            PENDING
        </div>
        @break
    
    @case("preparing")
        <div class="col-12 h5 my-0 text-warning">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            PREPARING
        </div>
        
        @break
 
    @case("ready")
        <div class="col-12 h5 my-0 text-success">
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            READY
        </div>    
        @break

    @case("served")
        <div class="col-12 h5 my-0 text-primary">SERVED</div>
        @break
    
    @case("cancelled")
        <div class="col-12 h5 my-0 text-danger">ORDER CANCELLED</div>
        @break

    @default
        <div class="col-12 my-0">Currently Unavailable</div>
    @endswitch

</div>


