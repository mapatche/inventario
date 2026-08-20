  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
    <input value="{{ old('first_name', $employee->first_name ?? '') }}" type="text" name="first_name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">   
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Apellido</label>
    <input value="{{ old('last_name', $employee->last_name ?? '')}}" type="text" name="last_name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Telefono</label>
    <input value="{{ old('phone', $employee->phone ?? '')}}" type="tel" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Correo</label>
    <input value="{{ old('email', $employee->email ?? '')}}" type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
  </div>

  <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Departamento</label>
    <select name="department_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
        @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id ?? '') == $department->id ? 'selected' : '' }} > {{ $department->name }}</option>
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