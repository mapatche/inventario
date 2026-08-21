@extends('layouts.app')

@section('contenido')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Control de Empleados</h1>
                <p class="mt-2 text-sm text-gray-600">Lista completa de los empleados registrados en el sistema.</p>
            </div>
            <a href="{{ route('employees.create') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-500 transition-colors cursor-pointer">
                + Nuevo Empleado
            </a>
        </div>
        <div class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Telefono</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Correo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Deparatmento</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($employees as $employee)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{  $employees->firstItem() +  $loop->iteration -1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $employee->phone }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $employee->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $employee->department->name }}</td>
                        <td class="px-6 py-4 text-sm text-right font-medium space-x-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('employees.edit', $employee) }}" class="text-blue-600 hover:text-blue-900 transition-colors">Editar</a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Eliminar?');">
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
            <div class="mt-6 ps-5">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection