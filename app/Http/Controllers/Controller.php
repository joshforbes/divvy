<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;


	/**
	 * The authenticated User
	 *
	 * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
	protected $user;

	/**
	 * Is the User signed in?
	 *
	 * @var
     */
	protected $signedIn;

	public function __construct()
	{
		$this->user = $this->signedIn = Auth::user();
	}
}
