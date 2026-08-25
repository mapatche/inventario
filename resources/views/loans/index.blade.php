@extends('layouts.app')

@section('contenido')
    <div class="max-w-8xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Visor de Asignaciones</h1>
                <p class="mt-2 text-sm text-gray-600">Lista completa de los items asignados en el sistema.</p>
            </div>
            <a href="{{ route('loans.create') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-500 transition-colors cursor-pointer">
                + Nuevo Item
            </a>
        </div>
        <div class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Empleado</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Marca</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Serie</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Notas</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($loans as $loan)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{  $loans->firstItem() +  $loop->iteration -1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $loan->employee->first_name . " " . $loan->employee->last_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $loan->item->type->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $loan->item->model }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $loan->item->serial }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $loan->notes }}</td>
                        <td class="px-6 py-4 text-sm text-right font-medium space-x-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('loans.edit', $loan) }}" class="text-blue-600 hover:text-blue-900 transition-colors">Editar</a>
                                <form action="{{ route('loans.destroy', $loan) }}" method="POST" onsubmit="return confirm('Eliminar?');">
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
                {{ $loans->links() }}
            </div>
        </div>
    </div>
@endsection