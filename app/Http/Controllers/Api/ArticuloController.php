<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        return Articulo::with('categoria')->get();
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id'
        ]);
        return Articulo::create($request->all());
    }
    public function show(Articulo $articulo)
    {
        return $articulo->load('categoria');
    }
    public function update(Request $request, Articulo $articulo)
    {
        $articulo->update($request->all());
        return $articulo;
    }
    public function destroy(Articulo $articulo)
    {
        $articulo->delete();
        return response()->noContent();
    }
}
