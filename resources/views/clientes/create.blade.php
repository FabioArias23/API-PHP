@extends('layouts.app')
@section('titulo', 'Alta de Cliente')
@section('contenido')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Nuevo Cliente</h2>
    <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4">
        @csrf {{-- ¡Importante para seguridad en Laravel! --}}

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" required>
            @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" required>
            @error('apellido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" required>
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm">
            @error('telefono') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
            <input type="text" name="dni" id="dni" class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" required>
            @error('dni') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Guardar Cliente
        </button>
    </form>
</div>
@endsection
