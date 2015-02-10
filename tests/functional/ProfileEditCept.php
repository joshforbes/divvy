<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user');
$I->wantTo('I want to edit my profile');

$I->signIn();

$I->click('Profile');
$I->seeCurrentUrlEquals('/johndoe');
$I->see('johndoe Profile');
$I->see('Name: John Doe');

$I->click('Edit Profile');
$I->seeCurrentUrlEquals('/johndoe/edit');

$data = [
    'name' => 'Johnny Doe',
    'location' => 'Anytown USA',
    'company' => 'IniTECH',
    'bio' => 'The life of Johnny Doe'
];

$I->editProfile($data);

$I->seeCurrentUrlEquals('/johndoe');
$I->see('johndoe Profile');
$I->see('Name: ' . $data['name']);
$I->seeRecord('profiles', $data);

