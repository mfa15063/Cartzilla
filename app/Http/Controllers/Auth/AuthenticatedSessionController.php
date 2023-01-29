<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();

        if(Auth::user()->is_admin){
            return redirect('/adminpanel');
        }
        return redirect('/');

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {

        return Socialite::driver('google')->redirect();
    }
    public function redirectToFB()
    {

        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {

            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            auth()->login($existingUser, true);
            if($existingUser->is_admin){

                return redirect('/adminpanel');
            }
            // log them in


        } else {
            // create a new user

                $name = $user->name;
                $names = explode(" ", $name);

            $newUser                  = new User;
            $newUser->first_name            = $names[0];
            $newUser->last_name            = $names[1];
            $newUser->email           = $user->email;
            $newUser->password       = bcrypt('password');
            $newUser->save();
            event(new Registered($newUser));
            auth()->login($newUser, true);
        }

        return redirect('/');

    }
    public function handleProviderCallbackFB()
    {

        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {

            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            auth()->login($existingUser, true);
            if($existingUser->is_admin){

                return redirect('/adminpanel');
            }
            // log them in

        } else {
            // create a new user
            $name = $user->name;
            $names = explode(" ", $name);

            $newUser                  = new User;
            $newUser->first_name            = $names[0];
            $newUser->last_name            = $names[1];
            $newUser->email           = $user->email;
            $newUser->password       = bcrypt('password');
            $newUser->save();
            event(new Registered($newUser));
            auth()->login($newUser, true);
        }

        return redirect('/');

    }
}
