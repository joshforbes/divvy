<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user');
$I->wantTo('I want to create a new project');

$I->signIn();

$I->fillField('title', 'Test project');
$I->click('button[type=submit]');


