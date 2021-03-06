<?php 
$I = new FunctionalTester($scenario);
$I->am('a registered Divvy user');
$I->wantTo('login to my Divvy account');

$I->assertFalse(Auth::check());

$username = 'testuser';
$email = 'testuser@example.com';
$password = '123456';
$name = 'Test User';

$user = $I->haveAnAccount([
    'username' => $username,
    'email' => $email,
    'password' => bcrypt($password),
    'name' => $name
]);

$I->amOnPage('/auth/login');
$I->fillField('email', $email);
$I->fillField('password', $password);
$I->click('input[type=submit]');

$I->seeCurrentUrlEquals('');
$I->assertTrue(Auth::check());
