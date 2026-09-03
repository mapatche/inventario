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
  
<div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 w-full">
  @foreach ($roles as $role)
    <label class="flex items-center px-4 py-2.5 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50/50 hover:border-blue-400 transition-all group bg-white">
      <div class="flex items-center gap-3">
        <input @checked(($userRole ?? null) === $role->name) type="radio" name="user_role" value="{{ $role->name }}" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 focus:ring-2">
        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-900">{{ $role->name }}</span>
      </div>
    </label>
    
  @endforeach

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