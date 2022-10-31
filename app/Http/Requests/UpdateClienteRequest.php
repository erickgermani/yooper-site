<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "nome" => "required|min:3|max:200",
            "email" => "required|email:rfc:dns|unique:clientes,email," . $this->id,
            "telefone" => "required|min:14|max:15",
            "nome-da-empresa" => "required|min:3|max:250",
            "servicos-contratados" => "required|min:3"
        ];
    }

    public function messages()
    {
        return [
            "telefone.min" => "O campo :attribute está em um formato inválido.",
            "telefone.max" => "O campo :attribute está em um formato inválido.",

            "nome-da-empresa.required" => "O campo nome da empresa é obrigatório.",

            "servicos-contratados.required" => "É necessário selecionar ao menos um serviço",
            "servicos-contratados.min" => "É necessário selecionar ao menos um serviço"
        ];
    }
}
