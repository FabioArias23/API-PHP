@extends('layouts.app')
@section('titulo', 'Editar Cliente')
@section('contenido')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Editar Cliente</h2>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT') {{-- ¡Importante! Usa el método PUT para actualizaciones --}}

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" required>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" required>
        </div>
        <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm">
        </div>
        <div>
            <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
            <input type="text" name="dni" id="dni" value="{{ old('dni', $cliente->dni) }}" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" required>
        </div>


        <div class="flex space-x-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Actualizar Cliente
            </button>
            <a href="{{ route('clientes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
