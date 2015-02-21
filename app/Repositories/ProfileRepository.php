<?php namespace App\Repositories;

use App\Profile;
use App\User;

class ProfileRepository {

    /**
     * Save an uploaded Avatar image to the profile
     *
     * @param Profile $profile
     * @param $avatar
     */
    public function saveAvatar(Profile $profile, $avatar)
    {
        $profile->avatar_path = $avatar->basename;
        $profile->save();
    }

    /**
     * Updates the profile for the provided username
     *
     * @param $username
     * @param $updatedData
     */
    public function updateProfileFor($username, $updatedData)
    {
        $profile = User::whereUsername($username)->firstOrFail()->profile;
        $profile->fill($updatedData)->save();
    }

    /**
     * Find a profile by the provided username
     *
     * @param $username
     * @return mixed
     */
    public function findByUsername($username)
    {
         return User::whereUsername($username)->firstOrFail()->profile;

    }

}