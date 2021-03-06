<?php
$I = new FunctionalTester($scenario);
$I->am('a Divvy user');
$I->wantTo('I want to upload a avatar to my profile');

$user = $I->signIn();

$I->click('Profile');
$I->seeCurrentUrlEquals('/testuser');
$I->click('.header__button');
$I->seeRecord('profiles', [
    'avatar_path' => null
]);

$I->attachFile('#avatar-input', 'avatar.jpg');
$I->click('Upload Avatar');

$I->seeCurrentUrlEquals('/testuser');
$I->seeElement('//img[@src="/images/avatars/' . $user->profile->avatar_path . '"]');
$I->seeRecord('profiles', [
    'user_id' => $user->id,
    'avatar_path' => $user->profile->avatar_path
]);

//cleanup
$imagePath = public_path() . '/images/avatars/';
\File::delete($imagePath . $user->profile->avatar_path);




