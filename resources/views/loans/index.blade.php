@extends('layouts.app')

@section('contenido')
    <div class="max-w-8xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Visor de Asignaciones</h1>
                <p class="mt-2 text-sm text-gray-600">Lista completa de los items asignados en el sistema.</p>
            </div>
            @canany(['OT SISTEMA PRESTA',
                    'OT PATIO MRO PRESTA',
                    'FISCOMEX SISTEMAS PRESTA',
                    'FISCOMEX PATIO PRESTA',])
            <a href="{{ route('loans.create') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-500 transition-colors cursor-pointer">
                + Asignar
            </a>
            @endcanany
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
                        @canany(['OT SISTEMA PRESTA',
                                'OT PATIO MRO PRESTA',
                                'FISCOMEX SISTEMAS PRESTA',
                                'FISCOMEX PATIO PRESTA',])
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Acciones</th>
                        @endcanany
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
                            @canany(['OT SISTEMA PRESTA',
                                    'OT PATIO MRO PRESTA',
                                    'FISCOMEX SISTEMAS PRESTA',
                                    'FISCOMEX PATIO PRESTA',])
                                <a href="{{ route('excelsior', $loan->id) }}" class="text-green-600 hover:text-blue-900 transition-colors">Formato</a>
                                @if(is_null($loan->loan_signature))
                                    <a href="#" 
                                        onclick="document.getElementById('loan_signature_input').click(); return false;" 
                                        class="inline-block p-2 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-500 transition-colors duration-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800"
                                        title="Subir imagen">
                                        
                                        <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                        </svg>
                                        </a>

                                        <input type="file" 
                                            id="loan_signature_input" 
                                            accept="image/*" 
                                            class="hidden" 
                                            data-employee="{{ $loan->employee_id }}" 
                                            data-item="{{ $loan->item_id }}" 
                                            onchange="subirImagen(this)" />
                                @endif
                            @endcanany
                        @role('ADMIN')
                                {{-- <a href="{{ route('loans.edit', $loan) }}" class="text-blue-600 hover:text-blue-900 transition-colors">Editar</a> --}}
                                <form action="{{ route('loans.destroy', $loan) }}" method="POST" onsubmit="return confirm('Eliminar?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors cursor-pointer">
                                        Finalizar
                                    </button>
                                </form>
                        @endrole
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

@if($loans->isNotEmpty())
<script>
async function subirImagen(input) {
  if (!input.files || input.files.length === 0) return;
  
  const archivo = input.files[0];
  const formData = new FormData();
  formData.append('loan_signature', archivo); 
  formData.append('_method', 'PUT'); 
  formData.append('_token', '{{ csrf_token() }}'); 
  formData.append('employee_id', input.dataset.employee);
  formData.append('item_id', input.dataset.item);

  try {
    const respuesta = await fetch("{{ route('loans.update', $loan) }}", { 
      method: 'POST',
      body: formData,
      headers: {
        'Accept': 'application/json'
      }
    });
    if (respuesta.ok) {
      alert('Imagen subida con éxito');
      window.location.href = "{{ route('loans.index') }}";
    } else {
      const errores = await respuesta.json();
      console.error('Errores del servidor:', errores);
      alert('Error en la validación del servidor. Revisa la consola.');
    }
    
  } catch (error) {
    console.error('Error en la conexión:', error);
    alert('Error de red al intentar conectar con el servidor.');
  } finally {
    input.value = '';
  }
}

</script>
@endif
@endsection