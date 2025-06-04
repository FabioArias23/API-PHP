@extends('layouts.app')
@section('titulo', 'Registrar Tratamiento')
@section('contenido')
 <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
 <h2 class="text-xl font-semibold mb-4">Nuevo Tratamiento</h2>
 <form action="{{ route('tratamientos.store') }}" method="POST"
class="space-y-4">
 @csrf
 <div>
 <label class="block text-sm font-medium">Mascota</label>
 <select name="mascota_id" class="w-full border border-gray-300 rounded
p-2">
 @foreach($mascotas as $mascota)
 <option value="{{ $mascota->id }}">{{ $mascota->nombre
}}</option>
 @endforeach
 </select>
 </div>
 <div>
 <label class="block text-sm font-medium">Descripción del
tratamiento</label>
 <textarea name="descripcion" class="w-full border border-gray-300
rounded p-2"></textarea>
 </div>
 <div>
 <label class="block text-sm font-medium">Fecha</label>
 <input type="date" name="fecha" class="w-full border border-gray-300
rounded p-2">
 </div>
 <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded
hover:bg-purple-700">
 Registrar Tratamiento
 </button>
 </form>
 </div>
@endsection
