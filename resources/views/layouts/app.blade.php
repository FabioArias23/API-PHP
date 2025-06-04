<html lang="es">
<head>
<meta charset="UTF-8">
<title>@yield('titulo', 'PetShop')</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-indigo-600 text-white p-4">
<h1 class="text-2xl font-bold">🐶 PetShop</h1>
</header>
<main class="p-6">
@yield('contenido')
</main>
<footer class="bg-indigo-100 text-center p-2 text-sm">
&copy; {{ date('Y') }} PetShop. Todos los derechos reservados.
</footer>
</body>
</html>
