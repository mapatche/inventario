<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
    <input value="{{ old('name', $user->name ?? '') }}" type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">   
</div>

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Correo</label>
    <input value="{{ old('email', $user->email ?? '') }}" type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">   
</div>

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
    <input value="" type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">   
</div>

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmar password</label>
    <input value="" type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">   
</div>







  <h2 class="text-lg font-semibold text-gray-800 mb-4">Selecciona el rol del usuario</h2>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
    
    <label class="flex items-center p-3.5 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50/50 hover:border-blue-400 transition-all group">
      <div class="flex items-center gap-3">
        <input @checked(($userRole ?? null) === 'visor_oficina') type="radio" name="user_role" value="visor_oficina" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 focus:ring-2">
        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-900">Visor Oficina</span>
      </div>
    </label>

    <label class="flex items-center p-3.5 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50/50 hover:border-blue-400 transition-all group">
      <div class="flex items-center gap-3">
        <input @checked(($userRole ?? null) === 'visor_patio') type="radio" name="user_role" value="visor_patio" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 focus:ring-2">
        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-900">Visor Patio</span>
      </div>
    </label>

    <label class="flex items-center p-3.5 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50/50 hover:border-blue-400 transition-all group">
      <div class="flex items-center gap-3">
        <input @checked(($userRole ?? null) === 'presta_oficina') type="radio" name="user_role" value="prestador_oficina" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 focus:ring-2">
        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-900">Prestador Oficina</span>
      </div>
    </label>

    <label class="flex items-center p-3.5 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50/50 hover:border-blue-400 transition-all group">
      <div class="flex items-center gap-3">
        <input @checked(($userRole ?? null) === 'presta_patio') type="radio" name="user_role" value="prestador_patio" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 focus:ring-2">
        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-900">Prestador Patio</span>
      </div>
    </label>

    <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50/50 hover:border-blue-400 transition-all group sm:col-span-2 bg-gray-50/50">
      <div class="flex items-center gap-3">
        <input @checked(($userRole ?? null) === 'admin') type="radio" name="user_role" value="admin" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 focus:ring-2">
        <span class="text-sm font-semibold text-gray-800 group-hover:text-blue-900">Administrador General</span>
      </div>
    </label>

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