<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServicoContratadoFactory extends Factory
{
    public function definition()
    {
        return [
            "cliente_id" => fake()->unique()->numberBetween(1, 100),
            "servico_id" => fake()->numberBetween(1, 4)
        ];
    }
}
