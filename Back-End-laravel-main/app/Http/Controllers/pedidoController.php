<?php

namespace App\Http\Controllers;

use App\Models\pedido;
use App\Models\marca;
use  App\Models\producto;
use  App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;
class pedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = DB::table('pedidos')
                ->join('clientes','pedidos.Cliente','=','clientes.id')
                ->select('pedidos.*','clientes.Nombre as Nombre_cliente')
                ->get();
        return view('pedido.index')->with('pedidos',$datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
