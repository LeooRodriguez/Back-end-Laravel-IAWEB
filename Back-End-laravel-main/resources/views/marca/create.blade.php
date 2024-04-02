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
                    <h2>Crear Marca </h2>
                    <form action="/marcas" method="POST">
                        @csrf
                        <div class ="mb-3">
                            <label for="" class="form-label">Nombre</label> 
                            <input id="Nombre" name="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror tabindex="1" value="{{ old('Nombre') }}">
                            @error('Nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                            <label for="" class="form-label">Comienza habilitado</label>
                            <input type="checkbox" id="Habilitado" name="Habilitado" checked >
                        </div>
                        <a href="/marcas" class="btn btn-secundary" tabindex="2">Cancelar</a>
                        <button type="submit" class= "btn btn-primary" tabindex="3">Guardar</button>
                    </form>
                    
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


