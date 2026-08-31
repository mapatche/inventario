@extends('layouts.guest')
@section('contenido')

    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md border border-gray-100">
       
<form method="POST" action="{{ route('login') }}">
@csrf
<div>
    <h1 class="text-center font-semibold text-xl">Iniciar Sesion</h1>
</div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1 mt-3">Correo</label>
        <input id="email" type="email" name="email" value="{{ old('email')}}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1 mt-3">Password</label>
        <input id="password" type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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
    class="mt-5 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
    Iniciar sesion
</button>
</form>
    </div>

@endsection