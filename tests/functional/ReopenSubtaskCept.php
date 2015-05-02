<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user that is assigned to a Task');
$I->wantTo('I want to reopen a completed subtask in a project');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id'  => $project->id,
    'name'        => 'A test task',
    'description' => 'Just a test',
], []);

$subTask = $I->haveASubTask([
    'task_id' => $task->id,
    'name'    => 'A subtask',
    'is_complete' => 1
]);

$I->amOnPage('/p/' . $project->id . '/task/' . $task->id);

$I->see('Reopen');
$I->seeRecord('subtasks', [
    'name' => 'A subtask',
    'is_complete' => 1
]);

$I->submitForm('.subtasks__controls form:nth-of-type(2)', []);

$I->dontSee('Reopen');
$I->see('A subtask');
$I->seeRecord('subtasks', [
    'name' => 'A subtask',
    'is_complete' => 0
]);