<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user');
$I->wantTo('I want to edit my profile');

$I->signIn();

$I->click('Profile');
$I->see('johndoe Profile');
$I->see('Name: John Doe');

$I->click('Edit Profile');

$name = 'Johnny Doe';
$location = 'Anytown USA';
$company = 'IniTECH';
$bio = 'The story of Johhny Doe';

$I->fillField('name', $name);
$I->fillField('location', $location);
$I->fillField('company', $company);
$I->fillField('bio', $bio);
$I->click('Submit');

$I->see('johndoe Profile');
$I->see('Name: Johnny Doe');
$I->seeRecord('profiles', [
    'name' => 'Johnny Doe',
    'location' => $location,
    'company' => $company,
    'bio' => $bio
]);

