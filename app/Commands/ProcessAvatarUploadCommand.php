<?php namespace App\Commands;

use App\Avatar;
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
	 * @param Avatar $avatar
	 * @param ProfileRepository $profileRepository
	 */
	public function handle(Avatar $avatar, ProfileRepository $profileRepository)
	{
		$profile = $profileRepository->findByUsername($this->username);

		$avatar = $avatar->create($this->file);

		$avatar->resizeAndCrop()->save();

		//if the Profile already has an avatar - delete the old one
		$avatar->delete($profile->avatar_path);

		$profileRepository->saveAvatar($profile, $avatar->getImage());
	}

}
