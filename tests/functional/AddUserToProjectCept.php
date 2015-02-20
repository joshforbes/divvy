<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a user to a project');

$secondUser = $I->haveAnAccount([
    'username' => 'janedoe',
    'email' => 'jane@test.com'
]);

$user = $I->signIn();
$project = $I->amAProjectAdmin($user);
$I->amOnPage('/p/' . $project->id);

//$I->selectOption('user', 'jane@test.com');
//$I->click('Add');
//
//$I->seeRecord('project_user', [
//    'project_id' => $project->id,
//    'user_id' => $secondUser->id
//]);