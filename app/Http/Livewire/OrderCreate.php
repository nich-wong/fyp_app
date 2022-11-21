<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderCreate extends Component
{   
    public $item_id; 
    public $count = 0;

    public function mount($item)
    {
        $this->item_id = $item->item_id;
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
        return view('livewire.order-create');
    }
}
