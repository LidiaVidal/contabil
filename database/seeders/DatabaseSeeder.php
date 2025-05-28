<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Tax;
use App\Models\Accounting;
use App\Models\Financial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
              // Criar algumas empresas
              $companies = Company::factory()->count(5)->create();

              // Para cada empresa criada, criar alguns usuários e dados relacionados
              $companies->each(function ($company) {
                  // Criar um usuário administrador para esta empresa
                  $adminUser = User::factory()->create([
                      'company_id' => $company->id,
                      'name' => 'Admin ' . $company->name,
                      'email' => 'admin_' . str()->random(5) . '@' . str($company->email)->after('@'), // Garante email único
                      'password' => Hash::make('password'), // Senha padrão
                  ]);
      
                  // Criar usuários regulares para esta empresa (excluindo o admin recém-criado)
                  $regularUsers = User::factory()
                      ->count(rand(2, 5)) // Cria entre 2 e 5 usuários regulares por empresa
                      ->create([
                          'company_id' => $company->id,
                      ]);
      
                  // Combinar o usuário admin e os usuários regulares para criar dados para todos
                  $allUsers = $regularUsers->push($adminUser);
      
                  // Criar impostos para esta empresa, associados a usuários aleatórios dela
                  Tax::factory()
                      ->count(rand(10, 30)) // Cria entre 10 e 30 impostos por empresa
                      ->create([
                          'company_id' => $company->id,
                          'user_id' => $allUsers->random()->id, // Associa a um usuário aleatório desta empresa
                      ]);
      
                  // Criar lançamentos contábeis para esta empresa, associados a usuários aleatórios dela
                  Accounting::factory()
                      ->count(rand(20, 50)) // Cria entre 20 e 50 lançamentos contábeis por empresa
                      ->create([
                          'company_id' => $company->id,
                          'user_id' => $allUsers->random()->id,
                      ]);
      
                  // Criar lançamentos financeiros para esta empresa, associados a usuários aleatórios dela
                  Financial::factory()
                      ->count(rand(30, 60)) // Cria entre 30 e 60 lançamentos financeiros por empresa
                      ->create([
                          'company_id' => $company->id,
                          'user_id' => $allUsers->random()->id,
                      ]);
              });
    }
}
