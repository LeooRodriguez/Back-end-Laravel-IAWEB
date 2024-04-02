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
        {{ __('Pedidos') }}
    </h2>
@endsection




<table id="pedidos"  class="table table-striped table-bordered shadow-lg mt-4" style="width:100%"">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">Cliente</th>
            <th scope="col">Fecha</th>
            <th scope="col">Direccion</th>
        </tr>
    </thead>
    <tbody>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

        <script>
        $(document).ready(function () {
        $('#pedidos').DataTable({
            "lengthMenu":[[5,10,50,-1],[5,10,50,"ALL"]]
            });
        });
        </script>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->Nombre_cliente }}</td>
            <td>{{ $pedido->Fecha }}</td>
            <td>{{ $pedido->Direccion }}</td>
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
    $('#pedidos').DataTable({
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




