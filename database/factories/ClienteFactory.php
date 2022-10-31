<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition()
    {
        return [
            "nome" => fake()->name(),
            "email" => fake()->unique()->safeEmail(),
            "telefone" => fake()->tollFreePhoneNumber(),
            "nome_da_empresa" => fake()->name(),
            "cadastrado_por" => 2,
            "atualizado_por" => fake()->numberBetween(1, 5)
        ];
    }
}
