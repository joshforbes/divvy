<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user that is assigned to a Task');
$I->wantTo('I want to delete a subtask');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id'  => $project->id,
    'name'        => 'A test task',
    'description' => 'Just a test',
], []);

$subTask = $I->haveASubTask([
    'task_id' => $task->id,
    'name'    => 'A subtask'
]);

$I->amOnPage('/p/' . $project->id);

$I->see('A subtask');
$I->seeRecord('subtasks', [
    'name' => 'A subtask'
]);

$I->click('input[value="Delete"]');
$I->seeCurrentUrlEquals('/p/' . $project->id);
$I->dontSee('A subtask');

$I->dontSeeRecord('subtasks', [
    'name' => 'A subtask'
]);



