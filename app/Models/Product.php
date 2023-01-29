<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Auth;
class Product extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = [
        'category_id',
        'created_by',
        'updated_by',
        'brand_id',
    ];
    public function getSlugOptions() : SlugOptions{
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('_');
    }
    function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    function user_category(){
        return $this->belongsTo('App\Models\CategoryUser', 'category_id','category_id')->where('user_id',Auth::user()->id);
    }
    function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
    public function ProductImages() {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function getColors(){
        return json_decode($this->color , true);
    }

    public function setColors($colors){
        $color = [];
        foreach ($colors as $key => $value) {
            $color[$key] = $value;
        }
        return json_encode($color);
    }


    public function order_details(){
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function wishlist(){
        return $this->hasMany('App\Models\WishList');
    }

    public function reviews(){
        return $this->hasMany('App\Models\ProductReview')->latest();
    }

    public function getPrice(){
        if(!Auth::check())
        {
            $n = $this->standard;
            $price = (int) $n;      // 1
            $fraction = $n - $price;

        }
        else{
            if(Auth::user()->price_category=="standard")
            {
                $n = $this->standard;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
            else if(Auth::user()->price_category=="premium")
            {
                $n = $this->premium;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
            else{
                $n = $this->gold;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
        }
        return $price;

    }
    public function getFraction(){
        if(!Auth::check()){
            $n = $this->standard;
            $price = (int) $n;      // 1
            $fraction = $n - $price;
        }
        else{
            if(Auth::user()->price_category=="standard")
            {
                $n = $this->standard;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
            else if(Auth::user()->price_category=="premium")
            {
                $n = $this->premium;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
            else{
                $n = $this->gold;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
        }
        return substr($fraction, 1, 3) ;

    }

    public function recommend($rating){
        return $this->reviews->where('rating' , $rating)->count();
    }

    public function ratingperc($total_for_spe){
        $total = $this->reviews->count();
        if($total != 0)
            return ($this->recommend($total_for_spe) / $total ) * 100;
        return 0;
    }

    public function rating(){
        return $this->reviews->avg('rating') ? $this->reviews->avg('rating') : 0;
    }

    
}
