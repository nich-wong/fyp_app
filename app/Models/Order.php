<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_no', 'date_time', 'order_total', 'order_status', 'payment_done', 'rest_id', 
    ];

    protected $primaryKey = 'order_id';

    public function orderlines()
    {
        return $this->hasMany(Orderline::class, 'order_id', 'order_id');
    }
}
