<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(ProjManag\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(ProjManag\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->name,
        'responsible'   => $faker->name,
        'email'         => $faker->email,
        'phone'         => $faker->phoneNumber,
        'address'       => $faker->address,
        'obs'           => $faker->sentence
    ];
});

$factory->define(ProjManag\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id'      => rand(1,10),
        'client_id'     => rand(1,10),
        'name'          => $faker->word,
        'description'   => $faker->sentence(10),
        'progress'      => rand(1,100),
        'status'        => rand(1,3),
        'due_date'      => $faker->dateTime('now')
    ];
});

$factory->define(ProjManag\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id'    => rand(1,10),
        'title'         => $faker->word,
        'note'          => $faker->paragraph,
    ];
});

$factory->define(ProjManag\Entities\ProjectTask::class,function(Faker\Generator $faker){
    return [
        'name'=>$faker->word,
        'project_id'=>rand(1,10),
        'start_date'=>$faker->dateTime('now'),
        'due_date'=>$faker->dateTime('now'),
        'status'=>rand(1,3)
    ];
});
