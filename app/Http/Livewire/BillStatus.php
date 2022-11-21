<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class BillStatus extends Component
{
    public $order_status;
    public $order_id;

    public function mount($order)
    {
        $this->order_id = $order->order_id;
    }

    public function render()
    {
        $orders = Order::all();
        foreach($orders as $order){
            if($order->order_id == $this->order_id){
                $this->order_status = $order->order_status;
            }
        }

        return view('livewire.bill-status', compact('orders'));
    }
}
