<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlertCount extends Component
{
    public $item_count;
    

    public function mount($item_count_total){
        $this->item_count = $item_count_total;

    }

    protected $listeners = [
        'inc_count' => 'inc_count',
        'dec_count' => 'dec_count',
    ];

    public function inc_count(){
        
        $this->item_count++;

    }

    public function dec_count(){
        
        $this->item_count--;

    }
    

    public function render()
    {
        return view('livewire.alert-count');
    }
}
