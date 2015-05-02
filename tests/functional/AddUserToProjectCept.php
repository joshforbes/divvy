<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a user to a project');

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

$I->amOnPage('/p/' . $project->id);

$I->selectOption('user', 'jane@test.com');
$I->click('input[type=submit]');

$I->selectOption('user', 'test@test.com');
$I->click('input[type=submit]');

$I->seeRecord('project_user', [
    'project_id' => $project->id,
    'user_id' => $secondUser->id
]);

$I->seeRecord('project_user', [
    'project_id' => $project->id,
    'user_id' => $thirdUser->id
]);