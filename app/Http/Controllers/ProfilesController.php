<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\EditProfileRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller {

	function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param UserRepository $userRepository
	 * @param $username
	 * @return Response
	 * @internal param int $id
	 */
	public function show($username)
	{
		$user = $this->userRepository->findByUsername($username);
		return view('profiles.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param UserRepository $userRepository
	 * @param $username
	 * @return Response
	 * @internal param int $id
	 */
	public function edit($username)
	{
		$user = $this->userRepository->findByUsername($username);
		return view('profiles.edit')->withUser($user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param EditProfileRequest $request
	 * @param $username
	 * @return Response
	 * @internal param int $id
	 */
	public function update(EditProfileRequest $request, $username)
	{
		$user = $this->userRepository->findByUsername($username);
		$user->profile->fill($request->all())->save();
		//Flash::message('Profile updated');
		return redirect()->route('profile.show', $user->username);
	}

}
