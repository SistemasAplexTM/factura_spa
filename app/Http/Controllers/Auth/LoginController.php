<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.loginv1');
    }

    protected function login(Request $request)
    {
      $validator = \Validator::make($request->all(), [
         'email' => 'required|email',
          'password' => 'required',
      ]);

      if ($validator->passes()) {
          if (auth()->attempt(array('email' => $request->input('email'),
            'password' => $request->input('password')),true))
          {
              return response()->json('success');
          }
          return response()->json([
              'error' => [
                  'email' => 'Sorry User not found.'
              ]
          ]);
      }

      return response()->json(['error'=>$validator->errors()->all()]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
      throw ValidationException::withMessages([
          $this->username() => [trans('auth.failed')],
      ])->redirectTo('login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return response()->json(['code' => 200]);
    }

}
