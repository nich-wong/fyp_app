<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'item_qty', 'orderline_price', 'order_id', 
    ];

    protected $primaryKey = 'orderline_id';

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }


}
