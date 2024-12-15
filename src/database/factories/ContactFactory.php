<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create('ja_JP');

        return [
            'category_id' => $faker->numberBetween(1, 5),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'gender' => $faker->numberBetween(1, 3),
            'email' => $faker->unique()->safeEmail,
            'tel' => $faker->phoneNumber,
            'address' => $faker->address,
            'building' => $faker->optional()->secondaryAddress,
            'detail' => $faker->text(200),
        ];
    }
}
