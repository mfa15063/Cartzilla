<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreWishListRequest;
use App\Http\Requests\UpdateWishListRequest;
use App\Models\WishList;
use Auth;
class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $wishlist = Wishlist::where('user_id' , Auth::user()->id)->paginate(5);
        return view('user.wishlist' , compact('wishlist'));

    }
    public function add($id){
        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = $id;
        $wishlist = WishList::updateOrCreate(
        $data,
        $data
        );
        $wasChanged = $wishlist->wasRecentlyCreated;
        if ( $wasChanged ) 
            return 1;
        else
            return 0;
    }


    public function remove($id){
        WishList::find($id)->delete();
    }
}
