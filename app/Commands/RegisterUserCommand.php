<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\Request;
use App\Profile;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterUserCommand extends Command implements SelfHandling {

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->username = $request->username;
		$this->email = $request->email;
		$this->password = $request->password;
	}

	/**
	 * Execute the command.
	 * Creates a new User and saves it to the database.
	 * Creates a new blank Profile and attaches it to the user.
	 *
	 *
	 * @param UserRepository $userRepository
	 * @return \App\User
	 */
	public function handle(UserRepository $userRepository)
	{
		$user = User::register($this->username, $this->email, $this->password);

		$userRepository->save($user);

		$userRepository->saveProfile(Profile::forNewUser(), $user);
		//email the user

		return $user;
	}

}
