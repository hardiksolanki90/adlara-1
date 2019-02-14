<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class AdminAuthController extends AdminController
{
    use AuthenticatesUsers, SendsPasswordResetEmails;

    private $request;

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    public function initContent()
    {
        return $this->template('auth.auth');
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

            $this->flash('error', 'Too many login attempts. Please try again in 1800 seconds');
            return redirect(url()->previous());
        }

        $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );

        if ($this->guard()->attempt(['email' => $data->email, 'password' => $data->password])) {
            return redirect(route('dashboard'));
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        $this->flash('danger', 'These credentials do not match our records.');
        return redirect(url()->previous());
    }

    public function initProcessLogout()
    {
          Auth::logout();
          return redirect('/login');
    }

    public function initContentPasswordReset()
    {
        return view('auth.passwords.email');
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

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
}
