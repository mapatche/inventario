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
      <img src="{{ asset('logofiscomex.png') }}" alt="Mi foto" class="w-auto h-auto rounded-lg">
      
      <nav class="space-y-1">

      </nav>
    </div>
  </aside>

  <main class="flex-1 p-8">
    @yield('contenido')
  </main>

</body>
</html>
