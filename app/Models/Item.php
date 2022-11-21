<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name', 'item_price', 'item_image', 'cat_id', 
    ];

    protected $primaryKey = 'item_id';
        
    public function categories()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'cat_id');
    }

    public function orderlines()
    {
        return $this->hasMany(Orderline::class, 'item_id', 'item_id');
    }
    
}
