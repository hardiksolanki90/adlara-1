<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\RegistersUsers;


class AuthController extends FrontController
{
    use AuthenticatesUsers, SendsPasswordResetEmails;

    private $request;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    public function initContentLogin()
    {
        
        return $this->template('auth.login');
    }

    public function initProcessLogin(Request $request)
    {
        $data = $this->validateFields([
          'email' => 'Email',
          'password' => 'Password'
        ]);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return json('error', 'Too many login attempts. Please try again in 1800 seconds');
        }

        $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );

        if (Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
            return jsonResponse('success', route('user.dashboard'));
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);


        return json('error', 'These credentials do not match our records.');
    }

    public function initProcessLogout()
    {
          Auth::logout();
          return redirect('login');
    }

    public function initContentPasswordReset()
    {
        if ($_SERVER['QUERY_STRING']) {
          $this->assign = array(
            'token' => $_SERVER['QUERY_STRING']
          );

          return $this->template('auth.passwords.reset');
        }

        return $this->template('auth.passwords.email');
    }

    public function initContentSetNewPassword($token = null)
    {
        $request = $this->request;
        $this->assign = [
          'token' => $token,
          'email' => $request->email
        ];
        return $this->template('auth.passwords.reset');
    }

    public function initProcessSendResetLink(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );


        return json('success', t('If your email is registered then you would have received a link to set a new password'));
    }
}
