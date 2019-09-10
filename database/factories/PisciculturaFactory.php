<?php

use Faker\Generator as Faker;
use nemo\Piscicultura;

$factory->define(Piscicultura::class, function (Faker $faker) {
    
    return [
        'nome'=>$faker->name,
    ];
});
