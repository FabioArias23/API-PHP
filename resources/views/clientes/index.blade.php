@extends('layouts.app')
@section('titulo', 'Listado de Clientes')
@section('contenido')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Clientes Registrados</h2>

    {{-- Mensaje de éxito si lo hay --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    {{-- Mensaje de error si lo hay (añadido para consistencia con el controlador) --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Botón para ir a crear un cliente --}}
    <div class="mb-4 flex space-x-4">
        <a href="{{ route('clientes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            Crear Nuevo Cliente
        </a>
         <a href="{{ route('users.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Volver a Usuarios
            </a>
    </div>

    @if ($clientes->isEmpty())
        <p>No hay clientes registrados aún.</p>
    @else
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">ID</th>
                    <th class="border px-4 py-2 text-left">Nombre</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-left">Teléfono</th>
                    <th class="border px-4 py-2 text-left">DNI</th>
                    {{-- Si tienes la columna 'direccion' en tu DB, DESCOMENTA la siguiente línea: --}}
                    {{-- <th class="border px-4 py-2 text-left">Dirección</th> --}}
                    <th class="border px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $cliente->id }}</td>
                        <td class="border px-4 py-2">{{ $cliente->nombre }}</td>
                        <td class="border px-4 py-2">{{ $cliente->email }}</td>
                        <td class="border px-4 py-2">{{ $cliente->telefono }}</td>
                        <td class="border px-4 py-2">{{ $cliente->dni }}</td>
                        {{-- Si tienes la columna 'direccion' en tu DB, DESCOMENTA la siguiente línea: --}}
                        {{-- <td class="border px-4 py-2">{{ $cliente->direccion ?? 'N/A' }}</td> --}} {{-- Muestra Dirección, con N/A si es null --}}
                        <td class="border px-4 py-2">
                            <div class="flex space-x-2"> {{-- Contenedor flex para alinear los botones --}}
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded-md text-xs text-center">Ver</a>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded-md text-xs text-center">Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este cliente?');" class="inline-block">
                                    @csrf
                                    @method('DELETE') {{-- Método HTTP DELETE para eliminación --}}
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-md text-xs text-center">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
