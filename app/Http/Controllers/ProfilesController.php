<?php namespace App\Http\Controllers;

use App\Avatar;
use App\Commands\ProcessAvatarUploadCommand;
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
        parent::__construct();

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
        $this->profileRepository->updateProfileFor($username, $request->all());

        //Flash::message('Profile updated');
        return redirect()->route('profile.show', $username);
    }

    /**
     *
     * Handles a user uploading an avatar image. Transforms into an InterventionImage object
     * resize to appropriate avatar size and save to avatar image folder. If the user
     * had an old avatar image, delete it then save the new path to the profile.
     *
     * @param UploadAvatarRequest $request
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadAvatar(UploadAvatarRequest $request, $username)
    {
        $this->dispatch(
            new ProcessAvatarUploadCommand($request->file('avatar-input'), $username)
        );

        return redirect()->route('profile.edit', $username);
    }

}
