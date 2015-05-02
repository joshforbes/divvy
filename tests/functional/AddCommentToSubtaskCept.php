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

$I->amOnPage('/p/' . $project->id .'/task/' . $task->id . '/subtask/' . $subtask->id);

$I->fillField('.comments__form__input', 'A test comment');
$I->click('Submit');

$I->seeRecord('comments', [
    'body' => 'A test comment',
    'user_id' => $user->id,
    'commentable_id' => $subtask->id,
    'commentable_type' => 'App\Subtask'
]);
