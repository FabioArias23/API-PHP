<?php

namespace App\Services;

use GuzzleHttp\Client;

class PokeApiService
{
    protected $client;
    protected $baseUrl = 'https://pokeapi.co/api/v2/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'verify' => false, // Solo para desarrollo, en producción asegúrate de tener SSL válido
        ]);
    }

    public function getPokemon($name)
    {
        try {
            $response = $this->client->get("pokemon/{$name}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Manejo de errores, por ejemplo, si el Pokémon no se encuentra (código 404)
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                if ($statusCode === 404) {
                    return null; // O podrías lanzar una excepción personalizada
                }
            }
            throw $e; // Re-lanza otras excepciones
        } catch (\Exception $e) {
            // Otros errores de conexión, etc.
            throw $e;
        }
    }

    public function getPokemonList($limit = 20, $offset = 0)
    {
        try {
            $response = $this->client->get("pokemon", [
                'query' => [
                    'limit' => $limit,
                    'offset' => $offset,
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
