@extends('layouts.app')

@section('contenido')
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Editar Item</h2>
        <form action="{{ route('items.update', $item) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            @include('items.formulario')
        </form>
    </div>
@endsection

