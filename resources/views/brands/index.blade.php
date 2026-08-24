@extends('layouts.app')

@section('contenido')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Marcas</h1>
                <p class="mt-2 text-sm text-gray-600">Lista completa de las marcas registradas en el sistema.</p>
            </div>
            <a href="{{ route('brands.create') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-500 transition-colors cursor-pointer">
                + Registrar Marca
            </a>
        </div>
        
        <div class="w-full overflow-hidden bg-white border border-gray-200 rounded-xl shadow-md">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Nombre</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @if ($brands->isNotEmpty())
                        @foreach ($brands as $brand)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{  $brands->firstItem() +  $loop->iteration -1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $brand->name }}</td>
                            <td class="px-6 py-4 text-sm text-right font-medium whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('brands.edit', $brand) }}" class="text-blue-600 hover:text-blue-900 transition-colors">Editar</a>
                                    <form action="{{ route('brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Eliminar?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors cursor-pointer">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="py-3 px-5 border-t border-gray-200 bg-gray-50">
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection
