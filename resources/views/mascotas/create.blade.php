@extends('layouts.app')
@section('titulo', 'Alta de Mascota')
@section('contenido')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
<h2 class="text-xl font-semibold mb-4">Nueva Mascota</h2>
<form action="{{ route('mascotas.store') }}" method="POST"
class="space-y-4">
@csrf
<div>
<label class="block text-sm font-medium">Cliente</label>
<select name="cliente_id" class="w-full border border-gray-300
rounded p-2">
@foreach($clientes as $cliente)
<option value="{{ $cliente->id }}">{{ $cliente->nombre
}}</option>
@endforeach
</select>
</div>
<div>
<label class="block text-sm font-medium">Nombre de la
Mascota</label>
<input type="text" name="nombre" class="w-full border
border-gray-300 rounded p-2">
</div>
<div>
<label class="block text-sm font-medium">Especie</label>
<input type="text" name="especie" class="w-full border
border-gray-300 rounded p-2">
</div>
<button type="submit" class="bg-green-600 text-white px-4 py-2
rounded hover:bg-green-700">
Guardar Mascota
</button>
</form>
</div>
@endsection
