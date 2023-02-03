<div wire:poll>
    <?php $orders_latest = $orders->reverse();?>
    
    @foreach($orders_latest as $order)
        @if(isset(Auth::user()->id) && Auth::user()->id == $order->rest_id) 
        <livewire:kitchen-view :order="$order" :wire:key="$order->order_id" />
        @endif
    @endforeach

</div>