<?php

$factory('App\User', [
    'username' => $faker->word,
    'email' => $faker->email,
    'password' => $faker->randomNumber(6),
    'created_at' => $faker->date(),
    'updated_at' => $faker->date()
]);

$factory('App\Profile', [
    'user_id' => 'factory:App\User',
    'name' => $faker->name,
    'company' => $faker->company,
    'location' => $faker->city,
    'bio' => $faker->paragraph(5),
    'created_at' => $faker->date(),
    'updated_at' => $faker->date()
]);

$factory('App\Project', [
    'name' => $faker->sentence()
]);

$factory('App\Task', [
    'project_id' => 'factory:App\Project',
    'name' => $faker->sentence(),
    'description' => $faker->paragraph(),
]);
