<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 2:09 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller {

	private $layout_variables = array();

	public function __construct() {

		$this->layout_variables = array(
			'config_url_base' => config('global.url_base'),
		);
	}

	public function login() {

		if (Auth::check() === true) {
			return redirect()->intended('/');
		}

		$method_variables = array();

		$data = array_merge($method_variables, $this->layout_variables);

		return view('auth.login', $data);
	}

	public function sign_in(Request $request) {
		$user_name = $request->input('user_name');
		$user_password = $request->input('user_password');
		$credentials = ['user_name' => $user_name, 'password' => $user_password];

		if (Auth::attempt($credentials)) {
			return redirect()->intended('/');
		} else {
			return redirect()->to('/login')->with('error', "Sorry, we couldn't verify your credentials. Please try again.");
		}
	}

	public function sign_out() {
		Auth::logout();

		return redirect()->to('/login');
	}

} 