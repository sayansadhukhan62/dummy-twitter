<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
         try
        {
            $detail = Socialite::driver($provider)->stateless()->user();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }

        $user = User::where('provider',$provider)->where('provider_id',$detail->id)->first();

        if(!$user){

            $user = User::create([
            'name' => $detail->name,
            'email' => $detail->email,
            'avatar' => $detail->avatar,
            'provider_id' => $detail->id,
            'provider' => $provider,
            'role_id' => '2',
        ]);
        }
        auth()->login($user);
        return redirect($this->redirectTo);
    }
}
