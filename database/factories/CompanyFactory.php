<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     
     * @return array<string, mixed>
     */
    protected $model = Accounting::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cnpj' => $this->faker->unique()->numerify('##.###.###/####-##'), // Gera um número com formato de CNPJ
            'address' => $this->faker->address(),
            'social' => $this->faker->sentence(),
        ];
    }
}
