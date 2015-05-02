<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory;

class UserTableSeeder extends Seeder {

    public function run()
    {
        // System
        $system = Factory::create('App\User', [
            'username' => 'System',
            'email' => 'system@divvytask.com'
        ]);

        $systemProfile = Factory::create('App\Profile', [
            'user_id' => $system->id,
            'name' => 'System',
            'company' => 'Divvy',
            'location' => null,
            'bio' => null
        ]);

        $systemProfile->avatar_path = 'system.jpg';
        $systemProfile->save();


        //John Doe
        $johndoe = Factory::create('App\User', [
            'username' => 'johndoe',
            'email' => 'johndoe@divvytask.com'
        ]);

        $johndoeProfile = Factory::create('App\Profile', [
            'user_id' => $johndoe->id,
            'name' => 'John Doe',
            'company' => 'Divvy',
            'location' => null,
            'bio' => null
        ]);

        $johndoeProfile->avatar_path = 'johndoe.jpg';
        $johndoeProfile->save();


        // Jane Doe
        $janedoe = Factory::create('App\User', [
            'username' => 'janedoe',
            'email' => 'janedoe@divvytask.com'
        ]);

        $janedoeProfile = Factory::create('App\Profile', [
            'user_id' => $janedoe->id,
            'name' => 'Jane Doe',
            'company' => 'Divvy',
            'location' => null,
            'bio' => null
        ]);

        $janedoeProfile->avatar_path = 'janedoe.jpg';
        $janedoeProfile->save();
    }

}