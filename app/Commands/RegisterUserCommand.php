<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\Request;
use App\Profile;
use App\Repositories\UserRepository;
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
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @param UserRepository $userRepository
	 * @return \App\User
	 */
	public function handle(UserRepository $userRepository)
	{
		$user = $userRepository->create($this->request->all());

		//NEED REPO
		$profile = $user->profile()->save(new Profile);
		//email the user

		return $user;
	}

}
