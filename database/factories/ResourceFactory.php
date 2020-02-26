<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Groups;
use App\Resource;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Resource::class, function (Faker $faker) {
    $groupId = Groups::pluck('id')->toArray();
    return [
        'name' => $faker->name,
        'group_id' => $faker->randomElement($groupId),
        'description' => $faker->text
    ];
});
