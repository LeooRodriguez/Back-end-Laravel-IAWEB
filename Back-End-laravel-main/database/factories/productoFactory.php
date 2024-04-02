<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\producto>
 */
class productoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$imagen = file_get_contents('public/img/logo.png');
        return [
            'Nombre' => $this->faker->word(),
            'Precio' => $this->faker->randomFloat(2, 1200, 7000),
            'Imagen' => base64_encode(file_get_contents('public/imagenes/logo.png')),
            'Descripcion'=>$this->faker->sentence(),
            'Stock'=> $this->faker->numberBetween(2,45),
            'Marca'=>$this->faker->randomElement(DB::table('marcas')->pluck('id')->toArray()),
            'Habilitado' => true
        ];
    }
}
