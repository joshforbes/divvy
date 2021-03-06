<?php

$factory('App\User', [
    'username'   => $faker->word,
    'email'      => $faker->email,
    'password'   => bcrypt(rand(100000, 99999)),
    'created_at' => $faker->date(),
    'updated_at' => $faker->date()
]);

$factory('App\Profile', [
    'user_id'    => 'factory:App\User',
    'name'       => $faker->name,
    'company'    => $faker->company,
    'location'   => $faker->city,
    'bio'        => $faker->paragraph(5),
    'created_at' => $faker->date(),
    'updated_at' => $faker->date()
]);

$factory('App\Project', [
    'name' => $faker->sentence()
]);

$factory('App\Task', [
    'project_id'  => 'factory:App\Project',
    'name'        => $faker->sentence(),
    'description' => $faker->paragraph(),
    'is_complete' => 0
]);

$factory('App\Subtask', [
    'task_id'     => 'factory:App\Task',
    'name'        => $faker->sentence(),
    'is_complete' => 0
]);

$factory('App\Discussion', [
    'title'   => $faker->sentence(),
    'body'    => $faker->paragraph(),
    'task_id' => 'factory:App\Task',
    'user_id' => 'factory:App\User'
]);

$factory('App\Comment', [
    'body'             => $faker->sentence(),
    'user_id'          => 'factory:App\User',
    'commentable_id'   => 'factory:App\Discussion',
    'commentable_type' => 'App\Discussion'
]);
