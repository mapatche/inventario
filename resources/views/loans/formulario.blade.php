  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipo</label>
      <select required id="type_id" name="type_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
        <option value="" disabled selected hidden>Selecciona un tipo</option>
        @foreach ($types as $type)
            <option value="{{ $type->id }}"> {{ $type->name }}</option>
        @endforeach
    </select>
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Equipos disponibles</label>
    <select required id="item_id" name="item_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
    </select>
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipo</label>
      <select required id="employee_id" name="employee_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
        <option value="" disabled selected hidden>Selecciona un Empleado</option>
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}"> {{ $employee->first_name . ' ' . $employee->last_name }}</option>
        @endforeach
    </select>
  </div>

  <div>
    <label class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm placeholder-gray-400 resize-y">Notas</label>
    <textarea rows="2" name="notes" id="notes" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes', $item->notes ?? '')}}</textarea>
  </div>

  <!-- Checkbox para permitir la salida -->
<div class="mt-4 flex items-center">
    <input type="checkbox" id="require_out" name="require_out" value="1" 
           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
    <label for="require_out" class="ml-2 text-sm font-semibold text-gray-700 select-none cursor-pointer">
        Requiere salida del área de trabajo
    </label>
</div>

<!-- Select de Autorización (Oculto por defecto usando 'hidden') -->
<div id="container_authorized_by" class="mt-4 hidden transition-all duration-300">
    <label class="block text-sm font-semibold text-gray-700 mb-1">Usuario que autoriza la salida</label>
    <select id="authorized_by_id" name="authorized_by_id" 
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
        <option value="" disabled selected hidden>Selecciona quién autoriza</option>
        @foreach ($aths as $authorizado) 
            <option value="{{ $authorizado->id }}"> {{ $authorizado->name }}</option>
        @endforeach
    </select>
</div>


  @if ($errors->any())
    <div class="max-w-md mx-auto mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<button
    type="submit"
    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
    Guardar
</button>





<script>

        document.addEventListener('DOMContentLoaded', function() {

        let sel_items = document.getElementById('item_id');
        sel_items.innerHTML = '<option value="" disabled selected hidden>No hay elementos disponibles</option>';

        document.getElementById('type_id').addEventListener('change', function() {
        sel_items.innerHTML = '';
        let idType = this.value;
        fetch(`items_by_type/${idType}`)
          .then(response => response.json())
          .then(data => {
            if(!data.length){
              sel_items.innerHTML = '<option value="" disabled selected hidden>No hay elementos disponibles</option>';
            }
            data.forEach(itemson => {
              sel_items.innerHTML += `<option value="${itemson.id}">${itemson.model} (${itemson.brand.name}) ${itemson.serial}</option>`;
            });
          });
        });
        });

        document.getElementById('require_out').addEventListener('change', function() {
                const container = document.getElementById('container_authorized_by');
                const select = document.getElementById('authorized_by_id');
                
                if (this.checked) {
                    container.classList.remove('hidden');
                    select.setAttribute('required', 'required'); // Se vuelve obligatorio si sale
                } else {
                    container.classList.add('hidden');
                    select.removeAttribute('required'); // Deja de ser obligatorio si no sale
                    select.value = ""; // Resetea el select si se desmarca
                }
            });


</script>