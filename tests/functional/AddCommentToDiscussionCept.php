<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a comment to a discussion');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id' => $project->id,
    'name' => 'A test task',
    'description' => 'Just a test',
], []);

$discussion = $I->haveADiscussion([
    'title' => 'A test discussion',
    'task_id' => $task->id,
    'user_id' => $user->id
]);

$I->amOnPage('/p/' . $project->id);
$I->click('A test discussion');
$I->seeCurrentUrlEquals('/p/' . $project->id . '/task/' . $task->id . '/discussion/' . $discussion->id);

$I->fillField('input[name="body"]', 'A test comment');
$I->click('input[value="Add this comment"]');

$I->seeRecord('comments', [
    'body' => 'A test comment',
    'user_id' => $user->id,
    'commentable_id' => $discussion->id,
    'commentable_type' => 'App\Discussion'
]);
