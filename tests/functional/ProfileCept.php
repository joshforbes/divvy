<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user');
$I->wantTo('I want to view my profile');

$I->signIn();

$I->click('Profile');
$I->see('johndoe', '.profile__username');
$I->see('John Doe', '.profile__info-item');

