<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menú') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @section('css')
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> 
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Marcas') }}
    </h2>
@endsection

<a href="marcas/create" class="btn btn-primary">Crear</a>

<table id="marcas"  class="table table-striped table-bordered shadow-lg mt-4" style="width:100%"">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">Nombre</th>
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
        $('#marcas').DataTable({
            "lengthMenu":[[5,10,50,-1],[5,10,50,"ALL"]]
            });
        });
        </script>
        @foreach($marcas as $marca)
        <tr>
            <td>{{ $marca->Nombre }}</td>
            @if($marca->Habilitado)
            <td style="color:green"> Habilitado </td>
            @else
            <td style="color:red"> Deshabilitado </td>
            @endif
            <td> 
                <form action="{{ route ('marcas.destroy',$marca->id) }}" method="POST">
                <a href="/marcas/{{  $marca->id }}/edit" class="btn btn-info">Editar</a>
                @csrf
                @method('DELETE')
                @if($marca->Habilitado)
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
    $('#marcas').DataTable({
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







