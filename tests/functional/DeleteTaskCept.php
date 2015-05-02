<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to delete a task from a project');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id' => $project->id,
    'name' => 'A test task',
    'description' => 'Just a test',
], []);

$I->amOnPage('/p/' . $project->id);

$I->see('A test task');
$I->seeRecord('tasks', [
    'name' => 'A test task',
    'deleted_at' => null
]);

$I->submitForm('.task-overview__settings form:last-child', []);
$I->seeCurrentUrlEquals('/p/' . $project->id);
$I->dontSee('A test task', '.task__header');

$I->dontSeeRecord('tasks', [
    'name' => 'A test task',
    'deleted_at' => null
]);
