<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticuloController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\PokemonController;
Route::apiResource('articulos', ArticuloController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('clientes', ClienteController::class);
Route::get('/', function () {
    return view('welcome');
});

// Ruta para mostrar un Pokémon específico por nombre
Route::get('/pokemon/{name}', [PokemonController::class, 'showPokemon']);

// Ruta para mostrar una lista de Pokémon
Route::get('/pokemons', [PokemonController::class, 'listPokemon']);
