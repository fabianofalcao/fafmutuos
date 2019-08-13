<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $user;
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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');
        $this->user = $user;
        if(auth()->check()){
            if($user->is_admin)
                $this->redirectTo = '/admin';
            else
                $this->redirectTo = '/client'; //'/aluno/meus-eventos';
        } else
            $this->redirectTo = '/login';
    }


    protected function sendLoginResponse(Request $request)
    {
        //dd($request->all());
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user = $this->user->find(auth()->user()->id);
        $user->setLastLogin();

        if(auth()->check()){
            if($user->is_admin)
                $this->redirectTo = '/admin';
            else
                $this->redirectTo = '/client'; //'/aluno/meus-eventos';
        } else
            $this->redirectTo = '/login';

        if(auth()->check()) {
            if ($user->is_admin) {
                $redirect = '/admin';
            } else {
                $redirect = '/client';
            }
        } else {
            $redirect = '/login';
        }

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($redirect);
    }
}
