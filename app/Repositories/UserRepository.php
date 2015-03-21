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

    /**
     * @param Profile $profile
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveProfile(Profile $profile, User $user)
    {
        return $user->profile()->save($profile);
    }

    /**
     * Find the specified User by ID
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($id)
    {
        return User::find($id);
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
        return User::with('profile')->whereEmail($email)->first();
    }

    /**
     * Return a key value array of Username => Email
     * for all users. Useful for building a select
     * box.
     *
     * @return mixed
     */
    public function getUsernameEmailArray()
    {
        return User::lists('username', 'email');
    }
}