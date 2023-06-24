<?php
use Waseem\Encipher\Tests\TestUser as User;
use Waseem\Encipher\Tests\TestSocialNetwork as SocialNetwork;

$factory->define(User::class, function (Faker\Generator $faker) use ($factory){
    return [
        'email' => $faker->email,
        'name' => $faker->name,
        'password'=> bcrypt($faker->password)
    ];
});

$factory->define(SocialNetwork::class, function (Faker\Generator $faker) use ($factory){
    return [
        'name' => $faker->word
    ];
});