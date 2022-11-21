<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_name', 'rest_id',
    ];

    protected $primaryKey = 'cat_id';

    public function items()
    {
        return $this->hasMany(Item::class, 'cat_id', 'cat_id');
    }
}
