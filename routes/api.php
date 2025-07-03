<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticuloController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\ProvinciaController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::apiResource('articulos', ArticuloController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('clientes', ClienteController::class);

use App\Models\Provincia;

Route::get('/importar-provincias', [ProvinciaController::class, 'importar']);

Route::get('/provincias', function () {
    return Provincia::all();
});

Route::get('/', function () {
    return view('welcome');
});

// Ruta para mostrar un Pokémon específico por nombre
Route::get('/pokemon/{name}', [PokemonController::class, 'showPokemon']);

// Ruta para mostrar una lista de Pokémon
Route::get('/pokemons', [PokemonController::class, 'listPokemon']);

// Registro
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);
    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json([
        'user' => $user,
        'token' => $token
    ], 201);
});
// Login
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
    $user = Auth::user();
    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json([
        'user' => $user,
        'token' => $token
    ]);
});
// Ruta protegida
Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
$request->user()->currentAccessToken()->delete();
return response()->json(['message' => 'Sesión cerrada']);
});
