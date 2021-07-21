<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de administración de categorías
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h3 class="border-b-2 border-indigo-400 mb-4 pb-2">Listado de marcas</h3>

                    <table class="w-auto shadow">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>categoría</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach( $categorias as $categoria )
                            <tr>
                                <td>{{ $categoria->idCategoria }}</td>
                                <td>{{ $categoria->catNombre }}</td>
                            </tr>
                    @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
