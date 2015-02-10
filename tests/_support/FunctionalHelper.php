<?php
namespace Codeception\Module;

use Codeception\Module;
use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends Module {

    public function editProfile(array $data)
    {
        $I = $this->getModule('Laravel5');

        $I->fillField('name', $data['name']);
        $I->fillField('location', $data['location']);
        $I->fillField('company', $data['company']);
        $I->fillField('bio', $data['bio']);
        $I->click('Submit');
    }

    public function signIn()
    {
        $username = 'johndoe';
        $email = 'johndoe@example.com';
        $password = '123456';
        $name = 'John Doe';

        $user = $this->haveAnAccount([
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        $this->haveAProfile([
            'user_id' =>  $user->id,
            'name' => $name
        ]);

        $I = $this->getModule('Laravel5');

        $I->amOnPage('/auth/login');
        $I->fillField('email', $email);
        $I->fillField('password', $password);
        $I->click('button[type=submit]');
    }

    public function haveAnAccount($overrides)
    {
        return TestDummy::create('App\User', $overrides);
    }

    public function haveAProfile($overrides)
    {
        return Testdummy::create('App\Profile', $overrides);
    }

}
