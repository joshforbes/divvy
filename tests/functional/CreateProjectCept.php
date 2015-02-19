<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user');
$I->wantTo('I want to create a new project');

$I->signIn();

$I->fillField('name', 'Test project');
$I->click('Create Project');

$I->seeCurrentUrlEquals('/p/1');
$I->see('Test project');

$I->seeRecord('projects', [
    'name' => 'Test project',
]);
