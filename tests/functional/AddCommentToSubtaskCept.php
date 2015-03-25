<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a comment to a subtask');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id' => $project->id,
    'name' => 'A test task',
    'description' => 'Just a test',
], []);

$subtask = $I->haveASubtask([
    'name' => 'A test subtask',
    'task_id' => $task->id,
]);

$I->amOnPage('/p/' . $project->id);
$I->click('A test subtask');
$I->seeCurrentUrlEquals('/p/' . $project->id . '/task/' . $task->id . '/subtask/' . $subtask->id);

$I->fillField('textarea[name="body"]', 'A test comment');
$I->click('input[value="Add"]');

$I->seeRecord('comments', [
    'body' => 'A test comment',
    'user_id' => $user->id,
    'commentable_id' => $subtask->id,
    'commentable_type' => 'App\Subtask'
]);
