<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "nome" => "required|min:3|max:200",
            "email" => "required|email:rfc:dns|unique:clientes",
            "telefone" => "required|min:14|max:15",
            "nome-da-empresa" => "required|min:3|max:250",
            "servicos-contratados" => "required|min:3"
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            "required" => "O campo :attribute é obrigatório",

            "min" => "O campo :attribute tem um mínimo de :min caracteres.",
            "max" => "O campo :attribute tem um mínimo de :max caracteres.",

            "telefone.min" => "O campo :attribute está em um formato inválido.",
            "telefone.max" => "O campo :attribute está em um formato inválido.",

            "email.email" => "O campo :attribute está inválido.",

            "nome-da-empresa.required" => "O campo nome da empresa é obrigatório.",

            "servicos-contratados.required" => "É necessário selecionar ao menos um serviço"
        ];
    }
}
