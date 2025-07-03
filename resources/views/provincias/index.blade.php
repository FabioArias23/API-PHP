<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provincias Argentinas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Listado de Provincias Argentinas</h1>

        {{-- Mostrar mensajes de error o éxito si existen en la sesión --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Verifica si hay provincias para mostrar --}}
        @if(empty($provincias) || count($provincias) === 0)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                No se encontraron provincias para mostrar. Intenta importarlas primero.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 border-b-2 border-gray-300 bg-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-4 border-b-2 border-gray-300 bg-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Nombre
                            </th>
                            {{-- NUEVA COLUMNA PARA LA IMAGEN --}}
                            <th class="px-6 py-4 border-b-2 border-gray-300 bg-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Imagen
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Itera sobre cada provincia en el array $provincias --}}
                        @foreach($provincias as $provincia)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-no-wrap text-gray-900 text-sm">
                                    {{ $provincia['id'] ?? $provincia->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-gray-900 text-sm">
                                    {{ $provincia['nombre'] ?? $provincia->nombre }}
                                </td>
                                {{-- CELDA PARA MOSTRAR LA IMAGEN --}}
                                <td class="px-6 py-4 whitespace-no-wrap text-gray-900 text-sm">
                                    @if($provincia['pathimage'] ?? $provincia->pathimage)
                                        <img src="{{ $provincia['pathimage'] ?? $provincia->pathimage }}"
                                             alt="Imagen de {{ $provincia['nombre'] ?? $provincia->nombre }}"
                                             class="w-24 h-auto object-cover rounded shadow">
                                    @else
                                        <span class="text-gray-500 text-xs">Sin imagen</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>

</html>
