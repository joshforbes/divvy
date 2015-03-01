<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to add a task to a project');

$user = $I->signIn();
$project = $I->amAProjectAdmin($user);

$I->amOnPage('/p/' . $project->id);

$I->click('Add a Task');
$I->seeCurrentUrlEquals('/p/' . $project->id . '/task/create');

$I->fillField('name', 'Test Task');
$I->fillField('description', 'A Test Task');
$I->click('Add');

$I->seeCurrentUrlEquals('/p/' . $project->id);
$I->see('Test Task');

$I->seeRecord('tasks', [
    'name' => 'Test Task',
    'description' => 'A Test Task']);