<?php
$I = new FunctionalTester($scenario);
$I->am('a logged in Divvy user');
$I->wantTo('Logout of my Divvy Account');

$I->signIn();
$I->assertTrue(Auth::check());

$I->click('Logout');
$I->amOnPage('/');
$I->assertFalse(Auth::check());

