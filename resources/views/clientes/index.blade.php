@extends('layouts.app')
@section('titulo', 'Listado de Clientes')
@section('contenido')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Clientes Registrados</h2>

    {{-- Mensaje de éxito si lo hay --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Botón para ir a crear un cliente --}}
    <div class="mb-4">
        <a href="{{ route('clientes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Crear Nuevo Cliente
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
                    <th class="border px-4 py-2 text-left">DNI</th> {{-- Añade DNI --}}
                    {{-- Puedes añadir más columnas aquí si las tienes en tu modelo y quieres mostrarlas --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $cliente->id }}</td>
                        <td class="border px-4 py-2">{{ $cliente->nombre }}</td>
                        <td class="border px-4 py-2">{{ $cliente->email }}</td>
                        <td class="border px-4 py-2">{{ $cliente->telefono }}</td>
                        <td class="border px-4 py-2">{{ $cliente->dni }}</td> {{-- Muestra DNI --}}
                        <td class="border px-4 py-2">{{ $cliente->direccion }}</td> {{-- Muestra Dirección --}}
                        <td class="border px-4 py-2">
                            {{-- Aquí puedes añadir botones de Ver, Editar, Eliminar --}}
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-2">Ver</a>
                            <a href="#" class="text-yellow-600 hover:text-yellow-900 mr-2">Editar</a>
                            <a href="#" class="text-red-600 hover:text-red-900">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
