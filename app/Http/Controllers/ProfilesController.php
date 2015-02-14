<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UploadAvatarRequest;
use App\Repositories\AvatarRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;

class ProfilesController extends Controller {

    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var ProfileRepository
     */
    private $profileRepository;

    /**
     * @param UserRepository $userRepository
     * @param ProfileRepository $profileRepository
     */
    function __construct(UserRepository $userRepository, ProfileRepository $profileRepository)
    {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
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
     * Update the profile
     *
     * @param UpdateProfileRequest $request
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request, $username)
    {
        $this->profileRepository->updateProfileForUser($username, $request);

        //Flash::message('Profile updated');
        return redirect()->route('profile.show', $username);
    }

    /**
     *
     * Upload the Avatar
     *
     * @param UploadAvatarRequest $request
     * @param $username
     * @param AvatarRepository $avatarRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadAvatar(UploadAvatarRequest $request, $username, AvatarRepository $avatarRepository)
    {
        $avatar = $avatarRepository->upload($request->file('avatar-input'));

        $profile = $this->userRepository->findByUsername($username)->profile;

        $avatarRepository->delete($profile->avatar_path);

        $this->profileRepository->saveAvatarToProfile($profile, $avatar);

        return redirect()->route('profile.edit', $username);
    }

}
