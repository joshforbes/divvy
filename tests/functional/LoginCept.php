<?php 
$I = new FunctionalTester($scenario);
$I->am('a registered Divvy user');
$I->wantTo('login to my Divvy account');

$I->assertFalse(Auth::check());

$I->signIn();

$I->seeCurrentUrlEquals('');
$I->assertTrue(Auth::check());
