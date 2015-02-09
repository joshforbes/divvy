<?php namespace App\Repositories;

use App\User;

class UserRepository {

    /**
     * Create a new user instance.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function findByUsername($username)
    {
        return User::with('profile')->whereUsername($username)->firstOrFail();
    }
}