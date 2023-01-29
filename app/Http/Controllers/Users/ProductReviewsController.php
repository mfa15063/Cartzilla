<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreProductReviewsRequest;
use App\Http\Requests\UpdateProductReviewsRequest;
use App\Models\ProductReview;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductReviewsController extends Controller
{
    public function add(Request $request)
    {
        $rules=  [
            'rating' => 'required', 
            'review' => 'required'
        ];
    
        $message =[
         'rating.required' => 'Rating is required',
         'review.required' => 'Review is required'
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $wishlist = ProductReview::updateOrCreate(
            ['user_id' => Auth::user()->id , 'product_id' =>  $request->product_id],
            $data
            );
            $wasChanged = $wishlist->wasRecentlyCreated;
            if ( $wasChanged ) 
                return response()->json(['success' => 'Review Added']);
            else
            return response()->json(['error' => 'Already Added']);
       
    }
}
