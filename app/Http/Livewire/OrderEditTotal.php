<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderEditTotal extends Component
{
    public $total_payment;
    protected $listeners = [
        'inc_total' => 'inc_total',
        'dec_total' => 'dec_total',
    ];

    public function mount($total_price)
    {
        $this->total_payment = $total_price;
    }

    public function inc_total($item_price){
        
        $this->total_payment += $item_price;

    }

    public function dec_total($item_price){
        
        $this->total_payment -= $item_price;

    }


    public function render()
    {
        return view('livewire.order-edit-total');
    }
}
