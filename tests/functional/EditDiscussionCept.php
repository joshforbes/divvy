<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to edit a discussion in a project');

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

$I->amOnPage('/p/' . $project->id . '/task/' . $task->id);

$I->see('A test discussion');
$I->seeRecord('discussions', [
    'title' => 'A test discussion',
    'deleted_at' => null
]);

$I->click('.discussions__controls__icon');
$I->submitForm('.discussion-form', [
    'title' => 'A discussion title',
    'body' => 'A discussion body',
]);

$I->see('A discussion title');

$I->seeRecord('discussions', [
    'title' => 'A discussion title',
    'body' => 'A discussion body',
    'task_id' => $task->id
]);
