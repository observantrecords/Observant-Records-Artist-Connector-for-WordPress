<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	/**
	 * Send a reset link to the given user.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);

		$credentials = array(
			'user_email' => $request->only('email'),
		);

		$response = Password::sendResetLink($credentials, function (Message $message) {
			$message->subject($this->getEmailSubject());
		});

		switch ($response) {
			case Password::RESET_LINK_SENT:
				return redirect()->back()->with('status', trans($response));

			case Password::INVALID_USER:
				return redirect()->back()->withErrors(['user_email' => trans($response)]);
		}
	}
}
