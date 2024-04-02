<?php

namespace App\Http\Controllers;
//vercel andando como siempre....
use Illuminate\Support\Facades\DB;
use App\Models\detalle_pedido;
use App\Models\pedido;
use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\marca;
use Carbon\Carbon;
use OpenApi\Annotations as OA;
use Exception;

class ApiController extends Controller
{
    /**
 * @OA\Get(
 *     path="/apis/productos",
 *     operationId="getProductos",
 *     tags={"Productos"},
 *     summary="Obtener lista de productos",
 *     @OA\Parameter(
 *         name="Habilitado",
 *         in="query",
 *         description="Filtrar por productos habilitados",
 *         @OA\Schema(type="boolean")
 *     ),
 *      @OA\Parameter(
 *         name="marcanombre",
 *         in="query",
 *         description="Filtrar por Marcas",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Operación exitosa",
 * 
 *        
 *     ),
 *     @OA\Response(response="400", description="Solicitud incorrecta")
 * )
 */

    public function productos(Request $request){
        $marcas = marca::all();
        $productos = producto::all();
        if($request->has('Habilitado')){
            $habilitado = filter_var($request->input('Habilitado'), FILTER_VALIDATE_BOOLEAN); //no estoy seguro si es 100% necesario, pero lo encontre asi
            $productos = $productos->where('Habilitado', $habilitado);
        }
       
        if ($request->has('marcanombre')) {
            $marcaNombre = $request->input('marcanombre');
            $marca = marca::all();
            $marca=$marca->where('Nombre', $marcaNombre)->first();
    
            if ($marca) {
                $productos=$productos->where('Marca', $marca->id);
            } else {
                $productos=$productos->where('Marca', null);
            }
        }

        foreach ($productos as $producto) {
            unset($producto->Imagen);
            unset($producto->id);
            $producto->Marca =  $marcas->where('id',$producto->Marca)->first()->Nombre;
        }
           
        return response()->json($productos);
   }

      /**
 * @OA\Get(
 *     path="/apis/marcas",
 *     operationId="getMarcas",
 *     tags={"Marcas"},
 *     summary="Obtener lista de marcas",
 *     @OA\Parameter(
 *         name="Habilitado",
 *         in="query",
 *         description="Filtrar por productos habilitados",
 *         @OA\Schema(type="boolean")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Operación exitosa",
 *        
 *     ),
 *     @OA\Response(response="400", description="Solicitud incorrecta")
 * )
 */
public function marcas(Request $request){
    
    $marcas = marca::all();
    if($request->has('Habilitado')){
        $habilitado = filter_var($request->input('Habilitado'), FILTER_VALIDATE_BOOLEAN); //no estoy seguro si es 100% necesario, pero lo encontre asi
        $marcas = $marcas->where('Habilitado', $habilitado);
    }
    foreach ($marcas as $marca) {
        unset($marca->id);
    }
    
    return response()->json($marcas);
}
 /**
     * @OA\Post(
     *     path="/apis/crearPedido",
     *     tags={"Pedido"},
     *     summary="Crea un nuevo pedido y sus detalles",
     *     operationId="crearPedido",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Cuerpo de la solicitud en formato JSON",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="cliente",
     *                     description="ID del cliente",
     *                     type="string",
     *                 ),
     *                  @OA\Property(
     *                     property="direccion",
     *                     description="Direccion del cliente",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="productos",
     *                     description="Lista de productos",
     *                     type="array",
     *                     @OA\Items(

     *                         @OA\Property(
     *                             property="nombre",
     *                             description="nombre del producto",
     *                             type="string",
     *                         ),
     *                         @OA\Property(
     *                             property="cantidad",
     *                             description="Cantidad del producto",
     *                             type="integer",
     *                         ),
     *                     ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *    @OA\Response(
 *         response="200",
 *         description="Operación exitosa",
 *        
 *          ),
 *     @OA\Response(response="500", description="Solicitud incorrecta")
 *              ),
     *         ),
     *     ),
     * )
     */
public function crearPedido(Request $datos){
    
    try{
    $productosBD = producto::all();
    $pedido = new pedido;
    $pedido->Cliente = $datos->cliente;
    $pedido->Direccion = $datos->direccion;
    $pedido->Fecha = Carbon::now();
    $pedido->save();
    foreach($datos->productos as $producto){
        $detallePedido = new detalle_pedido;
        $detallePedido->Cantidad = $producto['cantidad'];
        if($detallePedido->Cantidad<=0){
            throw new Exception("Cantidad debe ser mayor que 0");
        }
       
        $detallePedido->Pedido = $pedido->id; 
        $productoDB = $productosBD->where("Nombre", $producto['nombre'])->first();
        if($detallePedido->cantidad>$productoDB->Stock){
            throw new Exception("Cantidad no puede superar el Stock");
        }
        $productoDB->Stock = $productoDB->Stock- $detallePedido->Cantidad;
        $detallePedido->Producto = $productoDB->id;
        $detallePedido->Precio =  $productosBD->where("id",$productoDB->id)->first()->Precio * $detallePedido->Cantidad;
        $productoDB->update();
        $detallePedido->save();
    }

    DB::commit();

    return response()->json([
        'message'=>'Pedido y detalles creados exitosamente',
        'id_Pedido'=>$pedido->id
    ],200);
    }catch(Exception $e){
    DB::rollBack();
    return response()->json([
        'message'=>'Error al crear el pedido',
        'error'=>$e->getMessage()
    ],500);
    }
}

/**
     * @OA\Put(
     *     path="/apis/editarPedido",
     *     tags={"Pedido"},
     *     summary="Editar un pedido agregando producto o editandolos",
     *     operationId="editarPedido",
     *     @OA\Parameter(
     *     required=true,
 *         name="id",
 *         in="query",
 *         description="id del pedido, entregado al crear el mismo",
 *         @OA\Schema(type="string")
 *          ),
 *           @OA\Parameter(
 *         name="Direccion",
 *         in="query",
 *         description="direccion actualizada",
 *         @OA\Schema(type="string")
 *          ),
     *     @OA\RequestBody(
     *         description="Cuerpo de la solicitud en formato JSON",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="productos",
     *                     description="Lista de productos",
     *                     type="array",
     *                     @OA\Items(

     *                         @OA\Property(
     *                             property="nombre",
     *                             description="nombre del producto",
     *                             type="string",
     *                         ),
     *                         @OA\Property(
     *                             property="cantidad",
     *                             description="Cantidad del producto",
     *                             type="integer",
     *                         ),
     *                     ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *    @OA\Response(
 *         response="200",
 *         description="Operación exitosa",
 *        
 *          ),
 *     @OA\Response(response="500", description="Solicitud incorrecta")
 *              ),
 *       @OA\Response(response="404", description="Pedido no encontrado")
     *         ),
     *     ),
     * )
     */
public function editarPedido(Request $datos){
    $pedido = pedido::all()->where("id",$datos->input('id'))->first();
    if($pedido == null){
        return response()->json([
            'message'=>'Error pedido  no encontrado',
        ],404); //supongo que 404
    }else{
    try{
        if($datos->Direccion){
            $pedido->Direccion = $datos->Direccion;
        }
        
    $productosBD = producto::all();
    $detallesPedidos = detalle_pedido::all()->where("Pedido",$datos->id);
    if($datos->productos){
    foreach($datos->productos as $producto){
        $productoBD = $productosBD->where("Nombre", $producto['nombre'])->first();
        $detallePedido = $detallesPedidos->where("Producto",$productoBD->id)->first();
        if($detallePedido==null){//si el detalle pedido no existe creo uno nuevo
        $detallePedido = new detalle_pedido; 
        $detallePedido->Pedido = $pedido->id;
        $detallePedido->Producto = $productoBD->id;
        }
        if($producto['cantidad']<=0 || $producto['cantidad']==null){
            throw new Exception("Cantidad debe ser mayor que 0");
        }
        if($detallePedido->Cantidad>$producto['cantidad']){ //reducir cantidad
            $Recuperado = $detallePedido->Cantidad - $producto['cantidad'];
            $detallePedido->Cantidad = $producto['cantidad'];
            $productoBD->Stock = $productoBD->Stock + $Recuperado;

        }else if($detallePedido->Cantidad<$producto['cantidad']){//aumentar cantidad
            $extra =  $producto['cantidad'] -  $detallePedido->Cantidad;
            if($extra> $productoBD->Stock){
                throw new Exception("No puedes superar el Stock con la nueva cantidad");
            }else{
                $detallePedido->Cantidad = $producto['cantidad'];
                $productoBD->Stock = $productoBD->Stock - $extra;
            }
        }
        $productoBD->update();

        $detallePedido->Cantidad = $producto['cantidad'];
        $detallePedido->Precio =  $productosBD->where("id",$productoBD->id)->first()->Precio * $detallePedido->Cantidad;        //si se actualizo el precio y lo cambiaste te comes el precio nuevo
        $detallePedido->save();
        $detallePedido->update();
    }
    }
    $pedido->update();
    DB::commit();

    return response()->json([
        'message'=>'Pedido y detalles actualizados exitosamente'
    ],200);
    }catch(Exception $e){
    DB::rollBack();
    return response()->json([
        'message'=>'Error al actualizar el pedido',
        'error'=>$e->getMessage()
    ],500);
    }
    }
}

 /**
 * @OA\Get(
 *     path="/apis/pedidos",
 *     operationId="getPedidos",
 *     tags={"Pedido"},
 *     summary="Obtener lista de pedidos",
 *     @OA\Response(
 *         response="200",
 *         description="Operación exitosa",
 *        
 *     ),
 *     @OA\Response(response="400", description="Solicitud incorrecta")
 * )
 */
public function pedidos(Request $request){
    $detalles  = detalle_pedido::all();
    $pedidos = pedido::all();
    $productosBD = producto::all();
    foreach ($pedidos as $pedido) {
        $productos = [];
        foreach ($detalles as $detalle) {
            if ($detalle->Pedido == $pedido->id) {
                $producto =  producto::find($detalle->Producto);
                $productos[] = [
                    'nombre' => $producto->Nombre,
                    'cantidad' => $detalle->Cantidad,
                ];
            }
    }
    $pedido->productos=$productos;
    unset($pedido->id);
}
    
    return response()->json($pedidos);
}

/** 
    *     @OA\Put(
    *     path="/apis/eliminarPedido/{id}",
    *     operationId="eliminarPedido",
    *     tags={"Pedido"}, 
    *     summary="Elimina un pedido y sus detalles asociados",
    *     description="Elimina un pedido y sus detalles asociados en base a su ID.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del pedido a eliminar",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64"
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Pedido eliminado",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Pedido eliminado")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Pedido no encontrado",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Pedido no encontrado")
    *         )
    *     )
    * )
    */

public function eliminarPedido($id)
{

    $pedido = Pedido::find($id);

    if (!$pedido) {
        return response()->json(['message' => 'Pedido no encontrado'], 404);
    }

    $detalles = detalle_pedido::where('Pedido', $pedido->id)->get();

    foreach ($detalles as $detalle) {
        $producto = producto::find($detalle->Producto);
        $producto->Stock =$producto->Stock + $detalle->Cantidad; 
        $detalle->delete();
        $producto->update();
    }

    $pedido->delete();

    return response()->json(['message' => 'Pedido eliminado'], 200);
}




}

   


