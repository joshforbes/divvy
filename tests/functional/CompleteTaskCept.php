<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user that is assigned to a Task');
$I->wantTo('I want to complete a task in a project');

$user = $I->signIn();
Auth::loginUsingId($user->id);

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id'  => $project->id,
    'name'        => 'A test task',
    'description' => 'Just a test',
], []);

$I->amOnPage('/p/' . $project->id);

$I->see('A test task');
$I->seeRecord('tasks', [
    'name' => 'A test task',
    'is_complete' => 0
]);

$I->submitForm('.task__header__complete-form', []);

$I->see('A test task');
$I->see('re-open', '.task__header');
$I->seeRecord('tasks', [
    'name' => 'A test task',
    'is_complete' => 1
]);
