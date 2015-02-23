<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a user to a project');

$user = $I->signIn();

$secondUser = $I->haveAnAccount([
    'username' => 'janedoe',
    'email' => 'jane@test.com'
]);

$thirdUser = $I->haveAnAccount([
    'username' => 'testuser',
    'email' => 'test@test.com'
]);


$project = $I->amAProjectAdmin($user);


$I->amOnPage('/p/' . $project->id);

$I->selectOption('user', 'jane@test.com');
$I->click('Add');

$I->selectOption('user', 'test@test.com');
$I->click('Add');

$I->seeRecord('project_user', [
    'project_id' => $project->id,
    'user_id' => $secondUser->id
]);

$I->seeRecord('project_user', [
    'project_id' => $project->id,
    'user_id' => $thirdUser->id
]);