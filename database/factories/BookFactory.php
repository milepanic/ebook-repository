<?php

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase,
        'author' => $faker->name,
        'keywords' => $faker->bs,
        'publication_year' => $faker->year,
        'category_id' => $faker->numberBetween(1, 20),
    ];
});
