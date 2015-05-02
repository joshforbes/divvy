<?php
$I = new FunctionalTester($scenario);
$I->am('a guest');
$I->wantTo('sign up for Divvy');

$I->amOnPage('');
$I->click('Register');

$I->fillField('username', 'johndoe');
$I->fillField('email', 'test@test.com');
$I->fillField('password', 'password');
$I->click('button[type=submit]');

$I->seeCurrentUrlEquals('');
$I->seeRecord('users', [
    'username' => 'johndoe',
    'email' => 'test@test.com']);
$I->seeAuthentication();

$I->amOnPage('/johndoe');
$I->see('johndoe', '.profile__username');