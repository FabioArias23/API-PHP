<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PokeApiService; // Importa nuestro servicio

class PokemonController extends Controller
{
    protected $pokeApiService;

    public function __construct(PokeApiService $pokeApiService)
    {
        $this->pokeApiService = $pokeApiService;
    }

    public function showPokemon($name)
    {
        $pokemon = $this->pokeApiService->getPokemon($name);

        if ($pokemon) {
            return view('pokemon.show', ['pokemon' => $pokemon]);
        } else {
            return view('pokemon.notfound', ['name' => $name]);
        }
    }

    public function listPokemon()
    {
        $pokemonsData = $this->pokeApiService->getPokemonList(20, 0); // Obtener los primeros 20 Pokémon

        if ($pokemonsData && isset($pokemonsData['results'])) {
            $pokemons = $pokemonsData['results'];
            return view('pokemon.list', ['pokemons' => $pokemons]);
        } else {
            return view('pokemon.error', ['message' => 'No se pudo obtener la lista de Pokémon.']);
        }
    }
}
