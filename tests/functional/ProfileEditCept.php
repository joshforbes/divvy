<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user');
$I->wantTo('I want to edit my profile');

$I->signIn();
$I->amOnPage('');

$I->click('Profile');
$I->seeCurrentUrlEquals('/testuser');
$I->see('testuser', '.profile__username');
$I->see('Test User', '.profile__info-item');

$I->click('.header__button');

$data = [
    'name' => 'Johnny Doe',
    'location' => 'Anytown USA',
    'company' => 'IniTECH',
];

$I->editProfile($data);

$I->seeCurrentUrlEquals('/testuser');
$I->see('testuser', '.profile__username');
$I->see($data['name'], '.profile__info-item');
$I->seeRecord('profiles', $data);

