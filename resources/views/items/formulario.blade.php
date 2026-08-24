  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipo</label>
      <select name="type_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
        @foreach ($types as $type)
            <option value="{{ $type->id }}" 
              {{ old('type_id', $item->type_id ?? '') == $type->id ? 'selected' : '' }}

              > {{ $type->name }}</option>
        @endforeach
    </select>
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Marca</label>
    <select name="brand_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}"
              {{ old('brand_id', $item->brand_id ?? '') == $brand->id ? 'selected' : '' }}
              > {{ $brand->name }}</option>
        @endforeach
    </select>
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Modelo</label>
    <input value="{{ old('model', $item->model ?? '')}}" type="text" name="model" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Serie</label>
    <input value="{{ old('serial', $item->serial ?? '')}}" type="text" name="serial" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
  </div>

  <div>
    <label class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm placeholder-gray-400 resize-y">Notas</label>
    <textarea rows="2" name="notes" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes', $item->notes ?? '')}}</textarea>
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