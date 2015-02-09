<?php
$I = new FunctionalTester($scenario);
$I->am('a guest');
$I->wantTo('sign up for Divvy');

$I->amOnPage('/home');
$I->click('Register');

$I->fillField('username', 'johndoe');
$I->fillField('email', 'test@test.com');
$I->fillField('password', 'password');
$I->click('button[type=submit]');

$I->seeCurrentUrlEquals('/home');
$I->seeRecord('users', [
    'username' => 'johndoe',
    'email' => 'test@test.com']);
$I->seeAuthentication();

$I->amOnPage('/profile/johndoe');
$I->see('johndoe Profile');