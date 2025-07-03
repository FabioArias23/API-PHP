<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl w-full">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Lista de Usuarios</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($users->isEmpty())
            <p class="text-gray-600 text-center text-lg">No hay usuarios registrados.</p>
        @else
            <div class="overflow-x-auto"> {{-- Para desplazamiento horizontal en pantallas pequeñas --}}
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="py-3 px-4 border-b border-gray-200">ID</th>
                            <th class="py-3 px-4 border-b border-gray-200">Nombre</th>
                            <th class="py-3 px-4 border-b border-gray-200">Email</th>
                            <th class="py-3 px-4 border-b border-gray-200">Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 border-b border-gray-200">
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $user->id }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $user->name }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Si usas paginación, los enlaces de Tailwind se ven bien por defecto si usas el trait `WithTailwind` en tu Paginator --}}
            {{-- Puedes agregar los enlaces aquí si tienes paginación: --}}
            {{-- <div class="mt-4">
                {{ $users->links() }}
            </div> --}}

        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('register.form') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Registrar Nuevo Usuario
            </a>


        </div>
    </div>
    {{-- Añade este bloque en algún lugar visible de tu users/index.blade.php --}}
@auth {{-- Solo muestra si el usuario está autenticado --}}
    <div class="mt-6 text-center">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Cerrar Sesión
            </button>
        </form>
    </div>
@endauth
{{-- Fin del bloque de logout --}}

</body>
</html>
