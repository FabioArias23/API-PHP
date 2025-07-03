<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteWebController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/provincias', [ProvinciaController::class, 'index'])->name('provincias.index');

Route::get('/provincias/importar', [ProvinciaController::class, 'importar'])->name('provincias.importar');


Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Ruta para mostrar el formulario de registro
Route::get('/register-form', [RegisterController::class, 'showRegistrationForm'])->name('register.form');

// Ruta para manejar el envío del formulario de registro (POST)
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// ¡Vamos a crear este controlador!

// ... tus otras rutas existentes ...

// Rutas de autenticación (Login)
Route::get('/login-form', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Ruta para el logout (si aún no la tienes en web.php)
// NOTA: Si ya tienes una ruta '/logout' en api.php, esa es para tokens (Sanctum).
// Esta es para el sistema de autenticación web basado en sesiones/cookies.
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ... tus otras rutas ...

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
