<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest; 
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function store(CompanyFormRequest $request) 
    {
        // Se a validação passar (incluindo a regra max_digits:7 para o CNPJ),
        // você pode acessar os dados validados assim:
        $validatedData = $request->validated();

        // Prossiga com a lógica para salvar a empresa no banco de dados, etc.
        // Exemplo:
        // Company::create($validatedData);

        
        //return redirect('/empresas')->with('success', 'Empresa criada com sucesso!');
    }

    /**
     * Update the specified company in storage.
     */
    public function update(CompanyFormRequest $request, Company $company) // Use o CompanyFormRequest aqui também se necessário para atualizações
    {
        $validatedData = $request->validated();

        // Lógica para atualizar a empresa
        // $company->update($validatedData);

        // return redirect('/empresas')->with('success', 'Empresa atualizada com sucesso!');
    }

    // Outros métodos do controller (index, create, show, edit, destroy)
}
