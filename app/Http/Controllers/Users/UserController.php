<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'mobile_number' => 'required|digits:9',
            'state_id' => 'required_with:post_code,|digits_between:1,9',
            'city_id' => 'required_with:state_id|numeric',
            'postal_code' => 'required_with:city_id',
            'address' => 'required_with:post_code|min:8',
        ];


        if ($request->password != '') {
            $password = $request->password;
            $rules['password'] = 'required|min:8|max:30|confirmed';
        }
        $message =[
            'first_name.required' => 'First Name is required',
            'review.required' => 'Review is required'
           ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile_number = $request->mobile_number;
        if(isset($password)) {
            $user->password = Hash::make($request->password);
        }
        $user->city_id = $request->city_id;
        $user->state_id = $request->state_id;
        $user->post_code = $request->postal_code;
        $user->address = $request->address;
        $user->update();

    }


}
