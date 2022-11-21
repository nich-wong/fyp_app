<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class RefreshOrders extends Component
{
    public function render()
    {
        $orders = Order::all();
        return view('livewire.refresh-orders', compact('orders'));
    }
}
