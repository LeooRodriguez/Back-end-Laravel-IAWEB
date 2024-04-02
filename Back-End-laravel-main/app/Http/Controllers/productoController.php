<?php

namespace App\Http\Controllers;

use App\Models\marca;
use  App\Models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;
class productoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = DB::table('productos')
                ->join('marcas','productos.Marca','=','marcas.id')
                ->select('productos.*','marcas.Nombre as Nombre_marca')
                ->get();
        foreach($datos as $dato){
            $dato->Imagen = stream_get_contents($dato->Imagen);
        }
        //echo $datos;
        return view('producto.index')->with('productos',$datos);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = marca::where('Habilitado',true)->pluck('Nombre','id');
        return view('producto.create')->with('marcas',$marcas);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'Nombre' => 'required|max:255',
            'Descripcion' => 'required',
            'Precio' => 'required|numeric',
            'Stock'=> 'required',
            'imagen'=>'required'
        ]);

        $producto = new producto();

        $producto->Nombre = $request->get('Nombre');
        $producto->Stock = $request->get('Stock');
        $producto->Precio = $request->get('Precio');
        $producto->Descripcion = $request->get('Descripcion');
        $producto->Marca = $request->input('Marca');
        $producto->Habilitado = $request->get('Habilitado');
        if(!isset($producto->Habilitado))   //malditas checkbox
            $producto->Habilitado=false;
        $imagen = $request->file('imagen');
        //convertir a datos binarios
        $imagenBinaria = base64_encode($imagen->get());
        $producto->Imagen = $imagenBinaria;
        $producto->save();

        return redirect("/productos")->with('success', 'Producto guardado correctamente');
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
        
        $producto = producto::find($id);
        $marcas = marca::where('Habilitado',true)->pluck('Nombre','id');
        $marcaActual = marca::find($producto->Marca);
        return view('producto.edit')->with('producto',$producto)->with('marcas',$marcas)->with('marcaAct',$marcaActual);        //quizas hay una forma mejor
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'Nombre' => 'required|max:255',
            'Descripcion' => 'required',
            'Precio' => 'required|numeric',
            'Stock'=> 'required'
        
        ]);

        $producto = producto::find($id);

        $producto->Nombre = $request->get('Nombre');
        $producto->Stock = $request->get('Stock');
        $producto->Precio = $request->get('Precio');
        $producto->Descripcion = $request->get('Descripcion');
        $producto->Marca = $request->get('Marca');
        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            //convertir a datos binarios
            $imagenBinaria = base64_encode($imagen->get());
            $producto->Imagen = $imagenBinaria;
        }
        $producto->save();

        return redirect("/productos")->with('success', 'Producto guardado correctamente');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
  
        $producto = producto::find($id);
        if($producto != null)   // por si llegan dos formularios iguales
        if($producto->Habilitado){
            $producto->Habilitado = false;
          }else{
            $producto->Habilitado = true;
          }
            $producto->save();
        return redirect("/productos");
        //
    }
}
