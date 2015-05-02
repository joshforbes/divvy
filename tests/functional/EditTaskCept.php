<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy project admin');
$I->wantTo('I want to edit a task');

$user = $I->signIn();

$secondUser = $I->haveAnAccount([
    'username' => 'janetdoe',
    'email' => 'janet@test.com',
    'password' => '123456',
    'name' => 'Janet Doe'
]);

$thirdUser = $I->haveAnAccount([
    'username' => 'testguy',
    'email' => 'testguy@test.com',
    'password' => '123456',
    'name' => 'Test Guy'
]);

$fourthUser = $I->haveAnAccount([
    'username' => 'reagano',
    'email' => 'reagan@test.com',
    'password' => '123456',
    'name' => 'Reagano'
]);

$project = $I->amAProjectAdmin($user);

$I->addAUserToMyProject($secondUser, $project);
$I->addAUserToMyProject($thirdUser, $project);
$I->addAUserToMyProject($fourthUser, $project);

$task = $I->haveATask([
    'project_id' => $project->id,
    'name' => 'A test task',
    'description' => 'Just a test',
], [$secondUser]);

$I->amOnPage('/p/' . $project->id);

$I->click('.task-overview__setting');

$I->fillField('name', 'Updating name');
$I->fillField('description', 'Updating description');

$I->selectOption('memberList[]', ['testguy', 'reagano']);

$I->click('Save Changes');

$I->see('Updating name');
$I->see('Updating description');

$I->seeRecord('tasks', [
    'name' => 'Updating name',
    'description' => 'Updating description']);

$I->seeRecord('task_user', [
    'task_id' => $task->id,
    'user_id' => $thirdUser->id
]);

$I->seeRecord('task_user', [
    'task_id' => $task->id,
    'user_id' => $fourthUser->id
]);
