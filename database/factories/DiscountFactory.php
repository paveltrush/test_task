<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => code(16),
            'discount' => rand(1, 99),
            'date_active_from' => now()->format('Y-m-d'),
            'date_active_to' => now()->addDays(rand(1, 31))->format('Y-m-d'),
            'preview_text' => $this->faker->sentence,
            'project_id' => code(16),
            'name' => implode(" ", $this->faker->words(rand(1, 3)))
        ];
    }
}
