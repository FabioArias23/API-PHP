<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteWebController;
Route::get('/', function () {
    return view('welcome');
});



Route::resource('clientes', ClienteWebController::class)->names([
    'index' => 'clientes.index',
    'create' => 'clientes.create',
    'store' => 'clientes.store',
    'show' => 'clientes.show', // Asegúrate de que esta esté definida
    'edit' => 'clientes.edit',   // Asegúrate de que esta esté definida
    'update' => 'clientes.update', // ¡Importante! Esta es la que usa el formulario
    'destroy' => 'clientes.destroy',
]);

// Route::view('/clientes/crear', 'clientes.create');
// Route::get('/clientes', function () {
// $clientes = collect([
// (object)[ 'id' => 1, 'nombre' => 'Juan', 'email' => 'juan@mail.com', 'telefono' => '123456'
// ],
// (object)[ 'id' => 2, 'nombre' => 'Ana', 'email' => 'ana@mail.com', 'telefono' => '987654' ],
// ]);
// return view('clientes.index', compact('clientes'));
// });
