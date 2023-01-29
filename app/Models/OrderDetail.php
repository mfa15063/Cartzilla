<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_id',
    ];
    function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    function order(){
        return $this->belongsTo('App\Models\Order');
    }

    
}





