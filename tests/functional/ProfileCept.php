<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user');
$I->wantTo('I want to view my profile');

$I->signIn();

$I->click('Profile');
$I->see('testuser', '.profile__username');
$I->see('Test User', '.profile__info-item');

