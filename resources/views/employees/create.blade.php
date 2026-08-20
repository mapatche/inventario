<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Editar</title>
</head>
<body>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Guardar Empleado</h2>
        <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('employees.formulario')
        </form>
    </div>
</body>
</html>



