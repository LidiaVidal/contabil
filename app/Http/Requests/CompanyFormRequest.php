<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cnpj' => ['required', 'numeric', 'digits:14'],
        ];
    }
    public function messages(): array
    {
        return [
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.numeric' => 'O campo CNPJ deve conter apenas números.',
            'cnpj.digits' => 'O campo CNPJ deve ter exatamente 14 dígitos.',
        ];
    }    
}
