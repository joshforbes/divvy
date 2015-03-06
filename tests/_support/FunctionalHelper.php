<?php
namespace Codeception\Module;

use Auth;
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
            'password' => bcrypt($password),
            'name' => $name
        ]);

        $I = $this->getModule('Laravel5');

        $I->amOnPage('/auth/login');
        $I->fillField('email', $email);
        $I->fillField('password', $password);
        $I->click('button[type=submit]');

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

    public function haveAnAccount($overrides)
    {
        $user = TestDummy::create('App\User', $overrides);
        Testdummy::create('App\Profile', ['user_id' => $user->id] + $overrides);

        return $user;
    }

    public function haveAProject($overrides)
    {
        return Testdummy::create('App\Project', $overrides);
    }

    public function haveATask($overrides, array $users)
    {
        $task = Testdummy::create('App\Task', $overrides);
        foreach ($users as $user) {
            $task->users()->attach($user);
        }
        return $task;
    }

    public function haveASubtask($overrides)
    {
        $subtask = Testdummy::create('App\Subtask', $overrides);

        return $subtask;
    }

}
