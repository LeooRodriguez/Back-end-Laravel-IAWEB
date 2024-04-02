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

                    
                    <h2>Editar Producto </h2>
<form action="/productos/{{ $producto->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class ="mb-3">
        <div class ="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="Nombre" name="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror" tabindex="1"  value="{{$producto->Nombre}}">
            @error('Nombre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
    
            <label for="" class="form-label">Stock</label>
            <input id="Stock" name="Stock" type="number" class="form-control @error('Stock') is-invalid @enderror" tabindex="2"  value="{{$producto->Stock}}">
            @error('Stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            
            <label for="" class="form-label">Precio</label>
            <input id="Precio" name="Precio" type="number" class="form-control @error('Precio') is-invalid @enderror" tabindex="3"  value="{{$producto->Precio}}">
            @error('Precio')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
    
            <label for="" class="form-label">Descripcion</label>
            <input id="Descripcion" name="Descripcion" type="text" class="form-control @error('Descripcion') is-invalid @enderror" tabindex="4"  value="{{$producto->Descripcion}}">
            @error('Descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label for="" class="form-label">Marca:</label>
            <div>
                <select id="Marca" name="Marca">
                    @foreach ($marcas as $marca => $name)
                        <option value="{{ $marca }}" {{ $marca == $marcaAct->id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <label for="" class="form-label">Comienza habilitado</label>
            <input type="checkbox" id="Habilitado" name="Habilitado" checked >
            </div>
            <label for="" class="form-label">Imagen:</label>
            <div>
                 <img id="output"/>
                 <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control-file" name="imagen" id="imagen" >
                 @error('imagen')
                    <div class="invalid-feedback d-block" role="alert">
                        {{$message}}
                    </div>
                @enderror
                <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                            URL.revokeObjectURL(output.src)
                        }
                    };
                </script>
            </div>
        
    </div>
    <a href="/productos" class="btn btn-secundary" tabindex="6">Cancelar</a>
    <button type="submit" class= "btn btn-primary" tabindex="7">Guardar</button>
</form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


