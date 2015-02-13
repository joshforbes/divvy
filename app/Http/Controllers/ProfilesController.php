<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UploadAvatarRequest;
use App\Repositories\UserRepository;
use Intervention\Image\ImageManager as Image;

class ProfilesController extends Controller {

	/**
	 * @var UserRepository
     */
	protected $userRepository;

	/**
	 * @param UserRepository $userRepository
     */
	function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $username
	 * @return Response
	 * @internal param UserRepository $userRepository
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
	 * @param $username
	 * @return Response
	 * @internal param UserRepository $userRepository
	 * @internal param int $id
	 */
	public function edit($username)
	{
		$user = $this->userRepository->findByUsername($username);
		return view('profiles.edit')->withUser($user);
	}

	/**
	 * Update the Profile
	 *
	 * @param UpdateProfileRequest $request
	 * @param $username
	 * @return Response
	 * @internal param int $id
	 */
	public function update(UpdateProfileRequest $request, $username)
	{
		$user = $this->userRepository->findByUsername($username);
		$user->profile->fill($request->all())->save();
		//Flash::message('Profile updated');
		return redirect()->route('profile.show', $user->username);
	}

	/**
	 *
	 * Upload the Avatar
	 *
	 * @param UploadAvatarRequest $request
	 * @param $username
	 * @param Image $image
	 * @return \Intervention\Image\Image|Image
	 */
	public function uploadAvatar(UploadAvatarRequest $request, $username, Image $image)
	{
		$image = $image->make($request->file('avatar-input'));

		$imagePath = public_path() . '/images/avatars/';
		$image->resize(null, 200, function($constraint) {
			$constraint->aspectRatio();
		})->crop(200,200)->save($imagePath . uniqid() . '.jpg');

		$user = $this->userRepository->findByUsername($username);

		if (isset($user->profile->avatar_path)) {
			\File::delete($imagePath . $user->profile->avatar_path);
		}

		$user->profile->avatar_path = $image->basename;

		$user->profile->save();

		return redirect()->route('profile.edit', $user->username);

	}

}
