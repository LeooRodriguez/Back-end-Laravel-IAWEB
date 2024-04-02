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
                    {{ __("Has ingresado correctamente, Bienvenido!") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Como administrador tiene acceso a la visualización de Pedidos, Productos y Marcas.") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Tambien tiene acceso a la modificación de Productos y Marcas, puede acceder a ellos desde la barra de navegación arriba o simplemente apetando el botón especifico debajo de este mensaje, que tenga un buen dia.") }}
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap justify-center gap-4 sm:gap-8 mt-8">
        <a href="{{ route('pedidos') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 sm:py-6 sm:px-12 rounded-lg text-xl sm:text-3xl no-underline">Pedidos</a>
        <a href="{{ route('productos') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 sm:py-6 sm:px-12 rounded-lg text-xl sm:text-3xl no-underline">Productos</a>
        <a href="{{ route('marcas') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 sm:py-6 sm:px-12 rounded-lg text-xl sm:text-3xl no-underline">Marcas</a>
    </div>
</x-app-layout>


