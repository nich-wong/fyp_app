<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderEdit extends Component
{
    public $count;
    public $orderline_item_id;
    public $ol_price;
    public $item_price;
    public $orderline_item_name;
    

    public function mount($orderline)
    {
        $this->count = $orderline->item_qty;
        $this->orderline_item_id = $orderline->item_id;
        $this->ol_price = $orderline->orderline_price;
        $this->item_price = (($orderline->orderline_price) / ($orderline->item_qty));
        $this->orderline_item_name = $orderline->items->item_name;
    }


    public function increment()
    {
        $this->count++;
        $this->ol_price = $this->item_price * $this->count;
        $this->emit('inc_total', $this->item_price);
        $this->emit('inc_count');
    }

    public function decrement()
    {
        if($this->count > 0){  
            $this->count--;
            $this->ol_price = $this->item_price * $this->count;
            $this->emit('dec_total', $this->item_price);
            $this->emit('dec_count');
        }
    }


    public function render()
    {
        return view('livewire.order-edit');
    }
}
