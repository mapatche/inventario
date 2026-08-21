@extends('layouts.app')

@section('contenido')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Tipos de Recursos</h1>
                <p class="mt-2 text-sm text-gray-600">Lista completa de los tipos de recursos registrados en el sistema.</p>
            </div>
            <a href="{{ route('itemtypes.create') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-500 transition-colors cursor-pointer">
                + Nuevo Tipo
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
                    @if ($itemtypes->isNotEmpty())
                        @foreach ($itemtypes as $itemtype)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{  $itemtypes->firstItem() +  $loop->iteration -1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $itemtype->name }}</td>
                            <td class="px-6 py-4 text-sm text-right font-medium whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('itemtypes.edit', $itemtype) }}" class="text-blue-600 hover:text-blue-900 transition-colors">Editar</a>
                                    <form action="{{ route('itemtypes.destroy', $itemtype) }}" method="POST" onsubmit="return confirm('Eliminar?');">
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
            <!-- La paginación ahora ocupa todo el ancho inferior -->
            <div class="py-3 px-5 border-t border-gray-200 bg-gray-50">
                {{ $itemtypes->links() }}
            </div>
        </div>
    </div>
@endsection
