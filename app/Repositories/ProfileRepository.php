<?php namespace App\Repositories;

use App\Profile;
use App\User;

class ProfileRepository {

    public function saveAvatarToProfile(Profile $profile, $avatar)
    {
        $profile->avatar_path = $avatar->basename;
        $profile->save();
    }

    public function updateProfileForUser($username, $request)
    {
        $profile = User::whereUsername($username)->firstOrFail()->profile;
        $profile->fill($request->all())->save();
    }
}