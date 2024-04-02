<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    @section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Productos') }}
    </h2>
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> 
@endsection


<a href="productos/create" class="btn btn-primary">Crear</a>

<table id="producto"  class="table table-striped table-bordered shadow-lg mt-4" style="width:100%"">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Stock</th>
            <th scope="col">Precio</th>
            <th scope="col">Imagen</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Marca</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

        <script>
        $(document).ready(function () {
        $('#producto').DataTable({
            "lengthMenu":[[5,10,50,-1],[5,10,50,"ALL"]]
            });
        });
        </script>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->Nombre }}</td>
            <td>{{ $producto->Stock }}</td>
            <td>{{ $producto->Precio }}</td>
            <td> <img src={{"data:image/png;base64,".$producto->Imagen}} style="width:140px;"> </td>
            <td style="width:300px;">{{ $producto->Descripcion }}</td>
            <td>{{ $producto->Nombre_marca }}</td>
            @if($producto->Habilitado)
            <td style="color:green"> Habilitado </td>
            @else
            <td style="color:red"> Deshabilitado </td>
            @endif
            <td> 
                <form action="{{ route ('productos.destroy',$producto->id) }}" method="POST">
                <a href="/productos/{{  $producto->id }}/edit" class="btn btn-info">Editar</a>
                @csrf
                @method('DELETE')
                @if($producto->Habilitado)
                <button type="submit" style="background-color:red" class="btn btn-danger">Deshabilitar</button>
                @else
                <button type="submit" style="background-color:green" class="btn btn-danger">Habilitar</button>
                @endif
                </form>
            </td>
        </tr>
            
        @endforeach
    </tbody>
</table>

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#producto').DataTable({
        "lengthMenu":[[5,10,50,-1],[5,10,50,"ALL"]]
    });
});
</script>

@endsection
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




