<?php 
$I = new FunctionalTester($scenario);
$I->am('a registered Divvy user');
$I->wantTo('login to my Divvy account');

$I->signIn();

$I->seeCurrentUrlEquals('/home');
$I->see('You are logged in!');
$I->assertTrue(Auth::check());
