<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class productoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*
        DB::table('productos')->insert([
            'Nombre' => 'comida de gato gordo',
            'Stock' => 20,
            'Precio' => 50.25,
            'Descripcion' => 'No se, es para gatos gordos'
        ]);

        DB::table('productos')->insert([
            'Nombre' => 'comida de gato flaco',
            'Stock' => 20,
            'Precio' => 50.00,
            'Descripcion' => 'No se, es para gatos flacos'
        ]);
        */
        \App\Models\producto::factory(45)->create();
    }
}
