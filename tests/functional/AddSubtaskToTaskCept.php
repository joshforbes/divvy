<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a subtask to a task');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id' => $project->id,
    'name' => 'A test task',
    'description' => 'Just a test',
], []);

$I->amOnPage('/p/' . $project->id . '/task/' . $task->id);

$I->click('.header__button:nth-of-type(2)');
$I->fillField('input[name="name"]', 'A subtask');
$I->click('Save Subtask');

$I->see('A subtask');

$I->seeRecord('subtasks', [
    'name' => 'A subtask',
    'task_id' => $task->id
]);
