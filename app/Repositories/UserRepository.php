<?php namespace App\Repositories;

use App\Profile;
use App\User;

class UserRepository {

    /**
     * Persist a user
     *
     * @param User $user
     */
    public function save(User $user)
    {
        $user->save();
    }

    public function saveProfile(Profile $profile, User $user)
    {
        return $user->profile()->save($profile);
    }


    /**
     * Find a User by username with their Profile
     *
     * @param $username
     * @return mixed
     */
    public function findByUsername($username)
    {
        return User::with('profile')->whereUsername($username)->firstOrFail();
    }

    /**
     * Find a User by email
     *
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return User::whereEmail($email)->first();
    }
}