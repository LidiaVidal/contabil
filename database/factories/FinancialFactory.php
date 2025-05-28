<?php

namespace Database\Factories;

use App\Models\User; // Importe o modelo
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Financial>
 */
class FinancialFactory extends Factory
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
            'type' => $this->faker->randomElement(['Receita', 'Despesa', 'Ativo','Passivo']), 
            'description' => $this->faker->sentence(),
            'value' => $this->faker->randomFloat(2, 10, 1000), // 2 decimais, entre 10 e 1000
            'date' => $this->faker->date(),
            'competence_month' => $this->faker->date('M-y'),
        ];
    }
}
