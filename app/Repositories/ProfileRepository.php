<?php namespace App\Repositories;

use App\Profile;
use App\User;

class ProfileRepository {

    public function saveAvatarToProfile(Profile $profile, $avatar)
    {
        $profile->avatar_path = $avatar->basename;
        $profile->save();
    }

    public function updateProfileFor($username, $updatedData)
    {
        $profile = User::whereUsername($username)->firstOrFail()->profile;
        $profile->fill($updatedData)->save();
    }

    public function findByUsername($username)
    {
         return User::whereUsername($username)->firstOrFail()->profile;

    }

}