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

$I->amOnPage('/p/' . $project->id);

$I->see('A test discussion');
$I->seeRecord('discussions', [
    'title' => 'A test discussion',
    'deleted_at' => null
]);

$I->click(['class' => 'task__discussion__edit-button']);
$I->fillField('input[name="title"]', 'A discussion title');
$I->fillField('textarea[name="body"]', 'A discussion body');
$I->click('input[class="discussion-form__button"]');

$I->seeCurrentUrlEquals('/p/' . $project->id);
$I->see('A discussion title');

$I->click('A discussion title');
$I->see('A discussion title');
$I->see('A discussion body');

$I->seeRecord('discussions', [
    'title' => 'A discussion title',
    'body' => 'A discussion body',
    'task_id' => $task->id
]);
