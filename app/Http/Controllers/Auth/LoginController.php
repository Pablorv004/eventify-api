<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;


class LoginController extends BaseController
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

    // use AuthenticatesUsers;

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
        $this->middleware('auth')->only('logout');
    }
    
    /**
     * Show the login form.
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handles the login request. Uses the API.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function login(Request $request)
    {
        $apiLoginController = new \App\Http\Controllers\API\LoginController();
        $response = $apiLoginController->login($request);

        if ($response->getStatusCode() == 200) {
            return redirect('/')->with('success', 'User logged in successfully.');
        } else {
            return redirect()->back()->withErrors($response->getData()->message);
        }
    }

    /**
     * Logs out the user. Doesn't use the API.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'User logged out successfully.');
    }

}
