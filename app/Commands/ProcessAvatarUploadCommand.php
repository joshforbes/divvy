<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\Request;
use App\Repositories\AvatarRepository;
use App\Repositories\ProfileRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class ProcessAvatarUploadCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param $file
	 * @param $username
	 */
	public function __construct($file, $username)
	{
		$this->file = $file;
		$this->username = $username;
	}

	/**
	 * Execute the command.
	 *
	 * @param AvatarRepository $avatarRepository
	 * @param ProfileRepository $profileRepository
	 */
	public function handle(AvatarRepository $avatarRepository, ProfileRepository $profileRepository)
	{
		$profile = $profileRepository->findByUsername($this->username);

		$avatar = $avatarRepository->create($this->file);

		$avatarRepository->resizeAndCrop($avatar);

		$avatarRepository->save($avatar);

		//if the Profile already has an avatar - delete the old one
		$avatarRepository->delete($profile->avatar_path);

		$profileRepository->saveAvatarToProfile($profile, $avatar);
	}

}
