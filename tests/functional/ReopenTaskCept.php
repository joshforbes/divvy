T<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user that is assigned to a Task');
$I->wantTo('I want to reopen a completed task in a project');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id'  => $project->id,
    'name'        => 'A test task',
    'description' => 'Just a test',
    'is_complete' => 1
], []);

$I->amOnPage('/p/' . $project->id);

$I->see('A test task');
$I->seeRecord('tasks', [
    'name' => 'A test task',
    'is_complete' => 1
]);

$I->submitForm('.overview-overlay-wrapper form', []);

$I->see('A test task');
$I->dontSee('Reopen');
$I->see('Complete');
$I->seeRecord('tasks', [
    'name' => 'A test task',
    'is_complete' => 0
]);
