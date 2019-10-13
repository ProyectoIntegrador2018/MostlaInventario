<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserRole;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->to('/');
        }

        // only allow people with @itesm.mx or tec.mx to login
        $domain = explode("@", $user->email)[1];
        if (!in_array($domain, ['itesm.mx', 'tec.mx'])) {
            return redirect()->to('/');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // log them in
            Auth::login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;

            if ($givenRole = UserRole::where('email', $user->email)->first()) {
                $newUser->type_id = $givenRole->type_id;
            }

            $newUser->save();
            Auth::login($newUser, true);
        }
        
        return redirect($this->redirectTo);
    }
}
