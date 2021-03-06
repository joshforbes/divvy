<?php
namespace Codeception\Module;

use Auth;
use Codeception\Module;
use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class AcceptanceHelper extends Module
{
    public function signIn()
    {
        $username = 'testuser';
        $email = 'testuser@example.com';
        $password = '123456';
        $name = 'Test User';

        $user = $this->haveAnAccount([
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'name' => $name
        ]);

        $I = $this->getModule('Laravel5');

        $I->amOnPage('/auth/login');
        $I->fillField('email', $email);
        $I->fillField('password', $password);
        $I->click('input[type=submit]');

        Auth::loginUsingId($user->id);

        return $user;
    }

    public function haveAnAccount($overrides)
    {
        $user = TestDummy::create('App\User', [
            'username' => $overrides['username'],
            'password' => $overrides['password'],
            'email' => $overrides['email']
        ]);

        Testdummy::create('App\Profile', [
            'user_id' => $user->id,
            'name' => $overrides['name']
        ]);

        return $user;
    }

    public function amAProjectAdmin()
    {
        $project = $this->haveAProject([]);
        $user = Auth::user();

        $project->admins()->attach($user);
        $project->users()->attach($user);

        return $project;
    }

    public function addAUserToMyProject($user, $project)
    {
        $project->users()->attach($user);

        return $project;
    }

    public function haveAProject($overrides)
    {
        return Testdummy::create('App\Project', $overrides);
    }

}
