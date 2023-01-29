<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['main_menu_title'] = "User Management";
        $data['sub_menu_title'] = "Viewing all Users";
        $data['users'] = User::orderBy('users.id', 'desc');
        if ($request->first_name != '') {
            $data['users']->where('name', 'like', '%' . $request->name . '%');

        }
        if ($request->last_name != '') {
            $data['users']->where('name', 'like', '%' . $request->name . '%');

        }
        if ($request->date_from != '') {
            $data['users']->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($request->date_from)));
        }
        if ($request->date_to != '') {
            $data['users']->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->date_to)));
        }

        if ($request->city_id != '') {
            $data['users']->where('city_id', '=', $request->city_id);
        }

        $data['users'] = $data['users']->cursorPaginate(100);
        return view('backend.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|unique:users,email|email:rfc,dns',
            'password' => 'required|min:6|confirmed',
            'mobile_number' => 'required|digits:9',
            'state_id' => 'required_with:post_code,|digits_between:1,9',
            'city_id' => 'required_with:state_id|numeric',
            'post_code' => 'required_with:city_id|digits:4',
            'address' => 'required_with:post_code|min:8',
        ];
        $this->validate($request, $rules);
        $user=new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->password);
        $user->city_id = $request->city_id;
        $user->state_id = $request->state_id;
        $user->post_code = $request->post_code;
        $user->address = $request->address;
        $user->save();


        $request->session()->flash('success', 'New User has been added successfully!');
        return response('user created !', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $data['user'] = $user;
        view()->share('page_title', 'Client Information');
        view()->share('breadcrumbs', [['url' => url('users'), 'title' => 'Users']]);
        return view('backend.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['user'] = $user;

        return view('backend.users.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'email|unique:users,email,' . $user->email . ',email',
            'mobile_number' => 'required|digits:9',
            'state_id' => 'required_with:city_id,post_code,|digits_between:1,9',
            'city_id' => 'required_with:state_id,post_code|numeric',
            'post_code' => 'required_with:city_id|digits:4',
            'address' => 'required_with:post_code|min:8',
        ];

        if ($request->password != '') {
            $password = $request->password;
            $rules['password'] = 'required|min:8|max:30|confirmed';
        }
        $this->validate($request, $rules);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        if(isset($password)) {
            $user->password = Hash::make($request->password);
        }
        $user->city_id = $request->city_id;
        $user->state_id = $request->state_id;
        $user->post_code = $request->post_code;
        $user->address = $request->address;
        $user->save();
        $request->session()->flash('success', 'User has been updated successfully!');
        return response('User Updated !', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user->delete();
        return response('Success, User has been deleted', 200);
    }
    public function change_category(Request $request){
        $user= User::find($request->id);
        $user->price_category=$request->price_category;
        $user->save();
        return response()->json(['status' => 1,'Category' => $request->price_category]);

    }
}
