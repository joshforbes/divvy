<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a discussion to a task');

$user = $I->signIn();

$project = $I->amAProjectAdmin($user);

$task = $I->haveATask([
    'project_id' => $project->id,
    'name' => 'A test task',
    'description' => 'Just a test',
], []);

$I->amOnPage('/p/' . $project->id . '/task/' . $task->id);

$I->click('.header__button:nth-of-type(1)');
$I->fillField('input[name="title"]', 'A discussion title');
$I->fillField('textarea[name="body"]', 'A discussion body');
$I->click('Save Discussion');

$I->see('A discussion title');

$I->seeRecord('discussions', [
    'title' => 'A discussion title',
    'body' => 'A discussion body',
    'task_id' => $task->id
]);
