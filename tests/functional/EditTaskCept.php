<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to edit a task');

$user = $I->signIn();

$secondUser = $I->haveAnAccount([
    'username' => 'janedoe',
    'email' => 'jane@test.com'
]);

$thirdUser = $I->haveAnAccount([
    'username' => 'testuser',
    'email' => 'test@test.com'
]);

$fourthUser = $I->haveAnAccount([
    'username' => 'reagano',
    'email' => 'reagan@test.com'
]);

$project = $I->amAProjectAdmin($user);

$I->addAUserToMyProject($secondUser, $project);
$I->addAUserToMyProject($thirdUser, $project);
$I->addAUserToMyProject($fourthUser, $project);

$task = $I->haveATask([
    'project_id' => $project->id,
    'name' => 'A test task',
    'description' => 'Just a test',
], [$secondUser]);

$I->amOnPage('/p/' . $project->id);

$I->click('edit');
$I->seeCurrentUrlEquals('/p/' . $project->id . '/task/' . $task->id . '/edit');



$I->fillField('name', 'Updating name');
$I->fillField('description', 'Updating description');

$I->selectOption('memberList[]', ['testuser', 'reagano']);

$I->click('Add');

$I->seeCurrentUrlEquals('/p/' . $project->id . '/task/' . $task->id);
$I->see('Updating name');
$I->see('Updating description');
//$I->see('testuser');
//$I->see('reagano');

$I->seeRecord('tasks', [
    'name' => 'Updating name',
    'description' => 'Updating description']);

$I->seeRecord('task_user', [
    'task_id' => $task->id,
    'user_id' => $thirdUser->id
]);

$I->seeRecord('task_user', [
    'task_id' => $task->id,
    'user_id' => $fourthUser->id
]);
