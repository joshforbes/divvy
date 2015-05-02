<?php

$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a task to a project');

$user = $I->signIn();

$secondUser = $I->haveAnAccount([
    'username' => 'janedoe',
    'email' => 'jane@test.com',
    'password' => '123456',
    'name' => 'Jane Doe'
]);

$thirdUser = $I->haveAnAccount([
    'username' => 'testuser',
    'email' => 'test@test.com',
    'password' => '123456',
    'name' => 'Test User'
]);

$project = $I->amAProjectAdmin($user);

$I->addAUserToMyProject($secondUser, $project);
$I->addAUserToMyProject($thirdUser, $project);

$I->amOnPage('/p/' . $project->id);

$I->click('.header__button');

$I->fillField('name', 'Test Task');
$I->fillField('description', 'A Test Task');

$I->selectOption('memberList[]', ['johndoe', 'janedoe', 'testuser']);

$I->click('Save Task');

$I->seeCurrentUrlEquals('/p/' . $project->id);
$I->see('Test Task');

$I->seeRecord('tasks', [
    'name' => 'Test Task',
    'description' => 'A Test Task']);

$I->seeRecord('task_user', [
    'task_id' => '1',
    'user_id' => $user->id
]);

$I->seeRecord('task_user', [
    'task_id' => '1',
    'user_id' => $secondUser->id
]);

$I->seeRecord('task_user', [
    'task_id' => '1',
    'user_id' => $thirdUser->id
]);