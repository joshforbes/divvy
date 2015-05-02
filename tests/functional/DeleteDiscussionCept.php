<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to delete a discussion from a project');

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

$I->submitForm('.discussions__controls form', []);

$I->dontSee('A test discussion', '.task__discussion__title');

$I->dontSeeRecord('discussions', [
    'title' => 'A test discussion',
    'deleted_at' => null
]);
