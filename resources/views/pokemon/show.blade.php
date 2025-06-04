<!DOCTYPE html>
<html>
<head>
    <title>Detalles de Pokémon</title>
</head>
<body>
    <h1>{{ ucfirst($pokemon['name']) }}</h1>
    <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}">
    <p>ID: {{ $pokemon['id'] }}</p>
    <p>Altura: {{ $pokemon['height'] }}</p>
    <p>Peso: {{ $pokemon['weight'] }}</p>

    <h2>Habilidades:</h2>
    <ul>
        @foreach ($pokemon['abilities'] as $ability)
            <li>{{ ucfirst($ability['ability']['name']) }}</li>
        @endforeach
    </ul>

    <a href="/pokemons">Ver lista de Pokémon</a>
</body>
</html>
