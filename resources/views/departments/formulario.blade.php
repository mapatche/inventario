<div>
    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
        Nombre del Departamento
    </label>
    <input
        type="text"
        name="name"
        id="name"
        value="{{ old('name', $department->name ?? '') }}"
        placeholder="Ej. Recursos Humanos"
        class="w-full px-4 py-2 border rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('name') border-red-500 ring-2 ring-red-100 @else border-gray-300 @enderror">
    @error('name')
    <p class="mt-1 text-sm text-red-600 font-medium">
        {{ $message }}
    </p>
    @enderror
</div>
<button
    type="submit"
    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
    Guardar
</button>