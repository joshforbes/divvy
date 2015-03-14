<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a task to a project');

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

$I->addAUserToMyProject($secondUser, $project);
$I->addAUserToMyProject($thirdUser, $project);

$I->amOnPage('/p/' . $project->id);

$I->click('+ Task');
$I->seeCurrentUrlEquals('/p/' . $project->id . '/task/create');

$I->fillField('name', 'Test Task');
$I->fillField('description', 'A Test Task');

$I->selectOption('memberList[]', ['johndoe', 'janedoe', 'testuser']);

$I->click('Add');

$I->seeCurrentUrlEquals('/p/' . $project->id);
$I->see('Test Task');
//$I->see('janedoe');
//$I->see('testuser');

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