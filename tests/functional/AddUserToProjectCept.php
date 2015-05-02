<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a user to a project');

$user = $I->signIn();

$secondUser = $I->haveAnAccount([
    'username' => 'janetdoe',
    'email' => 'janet@test.com',
    'password' => '123456',
    'name' => 'Janet Doe'
]);

$thirdUser = $I->haveAnAccount([
    'username' => 'testguy',
    'email' => 'testguy@test.com',
    'password' => '123456',
    'name' => 'Test Guy'
]);


$project = $I->amAProjectAdmin($user);

$I->amOnPage('/p/' . $project->id);

$I->selectOption('user', 'janet@test.com');
$I->click('input[type=submit]');

$I->selectOption('user', 'testguy@test.com');
$I->click('input[type=submit]');

$I->seeRecord('project_user', [
    'project_id' => $project->id,
    'user_id' => $secondUser->id
]);

$I->seeRecord('project_user', [
    'project_id' => $project->id,
    'user_id' => $thirdUser->id
]);