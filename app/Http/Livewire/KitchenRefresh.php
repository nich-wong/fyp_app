<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class KitchenRefresh extends Component
{
    public function render()
    {
        $orders = Order::all();
        return view('livewire.kitchen-refresh', compact('orders'));
    }
}
