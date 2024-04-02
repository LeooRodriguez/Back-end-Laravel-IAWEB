<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\pedidoController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|hola
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/marcas', [marcaController::class, 'index'])->name('marcas');
    Route::get('marcas/create', [marcaController::class, 'create']);
    Route::get('marcas/{id}/edit', [marcaController::class, 'edit']);
    Route::delete('/marcas/{id}', [marcaController::class, 'destroy'])->name('marcas.destroy');
    Route::post('/marcas', [marcaController::class, 'store']);
    Route::put('/marcas/{id}', [marcaController::class, 'update']);
    
    Route::get('/productos', [productoController::class, 'index'])->name('productos');
    Route::get('productos/create', [productoController::class, 'create']);
    Route::get('productos/{id}/edit', [productoController::class, 'edit']);
    Route::delete('/productos/{id}', [productoController::class, 'destroy'])->name('productos.destroy');
    Route::post('/productos', [productoController::class, 'store']);
    Route::put('/productos/{id}', [productoController::class, 'update']);
    
    Route::get('/pedidos', [pedidoController::class, 'index'])->name('pedidos');
    //Route::resource('marcas','App\Http\Controllers\marcaController');
    //Route::resource('productos','App\Http\Controllers\productoController');

    //Pongo la ruta para los detalle_pedidos? rompe los requerimientos si lo hag9o
    //Investigue como hacer el menu desplegable pero no me da mas la cabeza hoy
});


//Rutas para la API verificar si modificando por apis funciona en vercel

Route::prefix('apis')->group(function () {
    Route::get('/productos', [ApiController::class, 'productos']);
    Route::get('/marcas', [ApiController::class, 'marcas']);
    Route::get('/pedidos', [ApiController::class, 'pedidos']);
    Route::post('/crearPedido', [ApiController::class, 'crearPedido']);
    Route::put('/editarPedido', [ApiController::class, 'editarPedido']);
    Route::put('/eliminarPedido/{id}', [ApiController::class, 'eliminarPedido']);
});


require __DIR__.'/auth.php';
