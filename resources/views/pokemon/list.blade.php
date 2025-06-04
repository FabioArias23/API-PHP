<!DOCTYPE html>
<html>
<head>
    <title>Lista de Pokémon</title>
</head>
<body>
    <h1>Lista de Pokémon</h1>
    <ul>
        @foreach ($pokemons as $pokemon)
            <li>
                <a href="/pokemon/{{ $pokemon['name'] }}">{{ ucfirst($pokemon['name']) }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
