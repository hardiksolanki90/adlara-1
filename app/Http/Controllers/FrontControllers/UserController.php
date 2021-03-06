<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends FrontController
{
    use ResetsPasswords;

    public function initContent()
    {
        return $this->template('user.dashboard');
    }

    public function initProcessResetPassword(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($response == Password::PASSWORD_RESET) {
          return jsonResponse('success', route('user.dashboard'));
        }

        return $this->sendResetFailedResponse($request, $response);
    }
}
