<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->integer('Stock');
            $table->float('Precio');
            $table->binary('Imagen'); 
            $table->string('Descripcion');
            $table->bigInteger('Marca');
            $table->foreign('Marca')->references('id')->on('marcas');
            $table->boolean('Habilitado');
            $table->timestamps();//?
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
