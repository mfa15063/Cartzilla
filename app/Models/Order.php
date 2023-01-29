<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Order extends Model
{
    use HasFactory;

    function user(){
        return $this->belongsTo('App\Models\User', 'order_by','id');
    }

    function items(){
        return $this->hasMany('App\Models\OrderDetail');
    }
    public function city(){
        return $this->belongsTo('App\Models\City' , 'checkout_city_id');
    }



    
    public function getCreatedAtAttribute($date){
        return Carbon::parse($date)->format('M d, Y');
    }
}
