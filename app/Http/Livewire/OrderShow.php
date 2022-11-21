<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderShow extends Component
{
    public $item_id; 
    public $count;

    public function mount($item, $orderline, $order)
    {
        $this->item_id = $item->item_id;
        $this->count = $orderline->item_qty;
        
        
    }

    public function increment()
    {
        $this->count++;
        $this->emit('inc_count');
    }

    public function decrement()
    {
        if($this->count > 0){  
            $this->count--;
            $this->emit('dec_count');
        }
    }

    public function render()
    {
        return view('livewire.order-show');
    }
}
