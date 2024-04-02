<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pedido>
 */
class pedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'Fecha' => $this->faker->dateTimeThisYear($max = 'now'),
            'Direccion' => $this->faker->address(),
            'Cliente'=>$this->faker->randomElement(DB::table('clientes')->pluck('id')->toArray())
        ];
    }
}
