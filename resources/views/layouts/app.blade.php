<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="bg-gray-100 flex">

  <aside class="w-64 h-screen bg-white border-r border-gray-200 p-4 flex flex-col justify-between">
    <div class="space-y-4">
      <img src="{{ asset('logofiscomex.png') }}" alt="Logo de FISCOMEX" class="w-auto h-auto rounded-lg">
      <h2 class="text-xl font-bold text-[#00347b] px-2 text-center">Inventario</h2>
      
      <nav class="space-y-1">

        <a href="{{url('/')}}" class="block px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 font-medium">
          Inicio
        </a>

        <details class="group" {{ request()->routeIs('employees.*', 'departments.*', 'loans.*') ? 'open' : '' }} >
          <summary class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 cursor-pointer font-medium select-none">
            <span>Personal</span>

            <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </summary>
          
          <div class="pl-6 pt-1 space-y-1">
          @role('admin')
            <a href="{{ route('departments.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('departments.*') ? 'font-bold' : '' }}">Departamentos</a>
            <a href="{{ route('employees.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('employees.*') ? 'font-bold' : '' }}">Empleados</a>
          @endrole
            <a href="{{ route('loans.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('loans.*') ? 'font-bold' : '' }}">Asignacion</a>
          </div>
        </details>

        <details class="group" {{ request()->routeIs('brands.*', 'itemtypes.*', 'items.*') ? 'open' : '' }} >
          <summary class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 cursor-pointer font-medium select-none">
            <span>Recursos</span>

            <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </summary>
          
          <div class="pl-6 pt-1 space-y-1">
          @role('admin')
            <a href="{{ route('itemtypes.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('itemtypes.*') ? 'font-bold' : '' }}">Tipos</a>
            <a href="{{ route('brands.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('brands.*') ? 'font-bold' : '' }}">Marcas</a>
          @endrole
            <a href="{{ route('items.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('items.*') ? 'font-bold' : '' }}">Items</a>
          </div>
        </details>

        @role('admin')
        <details class="group" {{ request()->routeIs('users.*', ) ? 'open' : '' }} >
          <summary class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 cursor-pointer font-medium select-none">
            <span>Admon</span>

            <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </summary>
          
          <div class="pl-6 pt-1 space-y-1">
            <a href="{{ route('users.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('users.*') ? 'font-bold' : '' }}">Usuarios</a>
          </div>
        </details>
        @endrole


        
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="mx-auto w-full block text-left px-3 py-2 text-red-800 rounded-lg hover:bg-gray-100 cursor-pointer font-medium">Salir</button>
        </form>
      </nav>
    </div>
  </aside>

  <main class="flex-1 p-8">
    @yield('contenido')
  </main>

</body>
</html>
