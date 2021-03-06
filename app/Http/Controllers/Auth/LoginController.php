<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    protected function credentials(Request $request)
    {
        $email = $this->username();

        $field = filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';

        return [
            $field => $request->get($email),
            'password' => $request->password,
        ];
    }

    protected function authenticated(Request $request, $user)
    {
        if(Auth::user()->role == 'admin')
        {
          return redirect('dashboard');
        }

        if(Auth::user()->role == 'backpacker')
        {
          return redirect('home');
        }
    }
}
