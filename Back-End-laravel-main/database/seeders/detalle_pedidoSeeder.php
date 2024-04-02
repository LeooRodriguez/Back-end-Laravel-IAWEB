<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\producto;
class detalle_pedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $producto = producto::inRandomOrder()->first(); 
        DB::table('detalle_pedidos')->insert([
            'Cantidad' => 4,
            'Pedido'=> 1,
            'Producto'=> $producto->id,
            'Precio'=> 4 * $producto->Precio,
        ]);

        $producto = producto::inRandomOrder()->first();
        DB::table('detalle_pedidos')->insert([
            'Cantidad' => 1,
            'Pedido'=> 2,
            'Producto'=> $producto->id,
            'Precio'=> 1 * $producto->Precio,
        ]);
        $producto = producto::inRandomOrder()->first();
        DB::table('detalle_pedidos')->insert([
            'Cantidad' => 42,
            'Pedido'=> 3,
            'Producto'=> $producto->id,
            'Precio'=> 42 * $producto->Precio,
        ]);
        
    }
}
