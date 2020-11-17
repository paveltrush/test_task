<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => code(rand(3, 10)),
            'first_name' => $this->faker->firstName,
            'second_name' => $this->faker->firstName('male'),
            'last_name' => $this->faker->lastName,
            'personal_mobile' => $this->faker->numerify('7##########'),
            'personal_phone' => $this->faker->numerify('7##########'),
            'date_register' => now()->subDays(rand(1,5)),
            'last_login' => now()
        ];
    }
}
