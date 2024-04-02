<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\marca;
use OpenApi\Annotations as OA;
class marcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos = marca::all();
        //echo $datos;
        return view('marca.index')->with('marcas',$datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $marca = new marca();

        $validatedData = $request->validate([
            'Nombre' => 'required|max:255'
        ]);

        $marca->Nombre = $request->get('Nombre');
        $marca->Habilitado = $request->get('Habilitado');
        if(!isset($marca->Habilitado))   //malditas checkbox
            $marca->Habilitado=false;
        $marca->save();

        return redirect("/marcas");
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
        
        $dato = marca::find($id);
        return view('marca.edit')->with('marca',$dato);
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'Nombre' => 'required|max:255'
        ]);

        $marca = marca::find($id);

        $marca->Nombre = $request->get('Nombre');

        $marca->save();

        return redirect("/marcas");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //probablemente lo cambiemos
        $marca = marca::find($id);
        if($marca != null) //pos si llegan dos formularios seguidos
          if($marca->Habilitado){
          $marca->Habilitado = false;
        }else{
          $marca->Habilitado = true;
        }
          $marca->save();
        return redirect("/marcas");

    }
}
