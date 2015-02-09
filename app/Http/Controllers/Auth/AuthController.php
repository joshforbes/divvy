<?php namespace App\Http\Controllers\Auth;

use App\Commands\RegisterUserCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar $registrar
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param RegisterUserRequest|\Illuminate\Foundation\Http\FormRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(RegisterUserRequest $request)
	{
		$user = $this->dispatch(
			new RegisterUserCommand($request)
		);

		$this->auth->login($user);

		return redirect($this->redirectPath());
	}


}
