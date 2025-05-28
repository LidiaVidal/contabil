<?php

namespace Database\Factories;

use App\Models\User; // Importe o modelo
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tax>
 */
class TaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(), 
            'user_id' => User::factory(), 
            'value' => $this->faker->randomFloat(2, 10, 1000), // 2 decimais, entre 10 e 1000
            'due_date' => $this->faker->date(),
            'type_tax' => $this->faker->sentence(),
            'tax_name' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Pago', 'Pendente', 'Atrasado']),
            'competence_month' => $this->faker->date('M-y'),
        ];
    }
}
