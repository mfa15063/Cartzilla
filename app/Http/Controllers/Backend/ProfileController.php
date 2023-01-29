<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Models\City;
class ProfileController extends Controller
{
    public function user_profile()
    {
        $data['main_menu_title'] = "Profile Management";
        $data['sub_menu_title'] = "Profile Update";
        return view('backend.profile.view-update-profile', $data);
    }

    public function user_profile_update(Request $request)
    {

        $user = \Auth::user();
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'email|unique:users,email,' . $user->email . ',email',
            'mobile_number' => 'required|digits:9',
            'state_id' => 'required_with:city_id,post_code,
|digits_between:1,9',
            'city_id' => 'required_with:state_id,post_code|numeric',
            'post_code' => 'required_with:city_id|digits:4',
            'address' => 'required_with:post_code|min:8',
        ];

        $this->validate($request, $rules);


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;

        $user->city_id = $request->city_id;
        $user->state_id = $request->state_id;
        $user->post_code = $request->post_code;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('success', 'Your profile has been updated successfully.');
    }

    public function change_password()
    {

        $data['main_menu_title'] = "Account Security";
        $data['sub_menu_title'] = "Change Password";
        return view('backend.profile.change-password', $data);
    }


    public function change_password_submit(Request $request)
    {

        $rules = [
            'current_password' => 'required|max:30',
            'password' => 'required|min:8|max:30|confirmed',
        ];
        $this->validate($request, $rules);

        $credentials = [
            'email' => \Auth::user()->email,
            'password' => $request->current_password
        ];

        if (\Auth::attempt($credentials)) {
            $user = \Auth::user();
            $user->password = bcrypt($request->password);
            $user->save();
            event(new PasswordReset($user));
            return redirect(url('/adminpanel'))->with('success', 'Your password has been updated successfully.');
        } else {

            return redirect()->back()->withErrors(['current_password' => 'The password you entered is wrong. Please try again.']);
        }
    }
}
