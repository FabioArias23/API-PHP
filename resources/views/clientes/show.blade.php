@extends('layouts.app')
@section('titulo', 'Detalle de Cliente')
@section('contenido')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Detalle del Cliente</h2>
    <p><strong>ID:</strong> {{ $cliente->id }}</p>
    <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>

    <p><strong>Email:</strong> {{ $cliente->email }}</p>
    <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
    <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
    <p><strong>Creado:</strong> {{ $cliente->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Última Actualización:</strong> {{ $cliente->updated_at->format('d/m/Y H:i') }}</p>

    <div class="mt-6 flex space-x-2">
        <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-md">Editar</a>
        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este cliente?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md">Eliminar</button>
        </form>
        <a href="{{ route('clientes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md">Volver</a>
    </div>
</div>
@endsection
