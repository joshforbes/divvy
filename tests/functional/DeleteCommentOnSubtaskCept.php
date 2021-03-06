<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to delete a comment on a subtask');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id' => $project->id,
    'name' => 'A test task',
    'description' => 'Just a test',
], []);

$subtask = $I->haveASubTask([
    'task_id' => $task->id,
    'name'    => 'A subtask'
]);

$comment = $I->haveACommentOn($subtask, [
    'body' => 'A test comment',
    'user_id' => $user->id
]);

$I->amOnPage('/p/' . $project->id . '/task/' . $task->id . '/subtask/' . $subtask->id);

$I->see('A test comment');
$I->seeRecord('comments', [
    'body' => 'A test comment',
    'deleted_at' => null
]);

$I->submitForm('.comment__settings form', []);
$I->dontSee('A test comment', '.comment__body');

$I->dontSeeRecord('comments', [
    'body' => 'A test comment',
    'deleted_at' => null
]);
