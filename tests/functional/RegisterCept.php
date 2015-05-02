<?php
$I = new FunctionalTester($scenario);
$I->am('a guest');
$I->wantTo('sign up for Divvy');

$I->amOnPage('');

$I->submitForm('.registration-wrapper form', [
    'username' => 'testuser',
    'email' => 'test@test.com',
    'password' => 'password'
]);

$I->seeCurrentUrlEquals('');
$I->seeRecord('users', [
    'username' => 'testuser',
    'email' => 'test@test.com']);
$I->seeAuthentication();

$I->amOnPage('/testuser');
$I->see('testuser', '.profile__username');