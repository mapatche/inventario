@extends('layouts.app')

@section('contenido')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Control de Items</h1>
                <p class="mt-2 text-sm text-gray-600">Lista completa de los items registrados en el sistema.</p>
            </div>
            <a href="{{ route('items.create') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-500 transition-colors cursor-pointer">
                + Nuevo Item
            </a>
        </div>
        <div class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Marca</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Modelo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Serie</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Notas</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($items as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{  $items->firstItem() +  $loop->iteration -1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->type->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->brand->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->model }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->serial }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->notes }}</td>
                        <td class="px-6 py-4 text-sm text-right font-medium space-x-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('items.edit', $item) }}" class="text-blue-600 hover:text-blue-900 transition-colors">Editar</a>
                                <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('Eliminar?');">
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
                </tbody>
            </table>
            <div class="py-3 px-5 border-t border-gray-200 bg-gray-50">
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection