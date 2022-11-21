
<div class="row justify-content-center fixed-bottom mb-3">
    <div class="col-9 text-center">
        @if($item_count == 0)
        <div class="alert alert-primary mb-0" role="alert">
            Must have at least 1 item.
        </div>
        @elseif($item_count != 0)
        <div class="alert alert-primary mb-0" role="alert" hidden>
            Total item count = {{$item_count}}
        </div>
        @endif
    </div>
</div>
