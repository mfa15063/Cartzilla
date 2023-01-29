<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'review',
        'rating',
    ];
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function reviews(){
        return $this->hasMany('App\Models\ProductReview');
    }
    public function getCreatedAtAttribute($date){
        return Carbon::parse($date)->format('M d, Y');
    }
}
