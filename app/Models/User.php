<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\State;
use App\Models\City;
use Auth;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'post_code',
        'city_id',
        'state_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function orders(){
        return $this->hasmany('App\Models\Order' , 'order_by')->latest();
    }
    public function reviews(){
        return $this->hasMany('App\Models\ProductReview');
    }
    public function wishlist(){
        return $this->hasMany('App\Models\WishList')->latest();
    }
    public function is_product($id){
        return Order::where('order_by' , Auth::user()->id)->whereRelation('items' , function ($query) use ($id){
            $query->where('product_id' , $id);
        })->count() > 0 ? true : false;
    }

    public function priceColumnName(){
        if (Auth::user()->price_category=="standard") {
            return "standard";
        } elseif (Auth::user()->price_category=="premium") {    
            return "premium";
        } else {
            return "gold";
        }
    }
}
