<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Orderline;
use App\Models\Order;

class KitchenView extends Component
{
    public $count = 0;
    public $status;
    public $payment;
    public $order;
    public $status_payment;
    public $order_id;

    public function mount($order)
    {
        $this->order = $order;
        $this->status = $order->order_status;
        $this->payment = $order->payment_done;
        $this->status_payment = $order->payment_done;
        $this->order_id = $order->order_id;
    }

        // public function click_payment_false()
        // {
        //     $this->count++; 
        //     if($this->count % 2 == 1){
        //         $this->order->payment_done = "true";
        //     }
        //     elseif ($this->count % 2 == 0){
        //         $this->order->payment_done = "false";
        //     }
        //     $this->order->save();
        //     $this->status_payment = $this->order->payment_done;
        // }

        // public function click_payment_true()
        // {
        //     $this->count++; 
        //     if($this->count % 2 == 1){
        //         $this->order->payment_done = "false";
        //     }
        //     elseif ($this->count % 2 == 0){
        //         $this->order->payment_done = "true";
        //     }
        //     $this->order->save();
        //     $this->status_payment = $this->order->payment_done;
        // }

        // public function click_prep_btn()
        // {
        //     $this->order->order_status = "preparing";
        //     $this->order->save();
        //     $this->status = $this->order->order_status;
        // }

        // public function click_ready_btn()
        // {
        //     $this->order->order_status = "ready";
        //     $this->order->save();
        //     $this->status = $this->order->order_status;
        // }

        // public function click_served_btn()
        // {
        //     $this->order->order_status = "served";
        //     $this->order->save();
        //     $this->status = $this->order->order_status;
        // }

        // public function click_cancel_btn()
        // {
        //     $this->order->order_status = "cancelled";
        //     $this->order->save();
        //     $this->status = $this->order->order_status;
        // }


    public function render()
    {
        $orders = Order::all();
        $orderlines = Orderline::all();

        foreach($orders as $order){
            if($order->order_id == $this->order_id){
                $this->status = $order->order_status;

                $this->status_payment = $order->payment_done;
            }
        }
        return view('livewire.kitchen-view', compact('orderlines', 'orders'));
    }
}
