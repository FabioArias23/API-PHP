<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Importa el modelo User
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Para iniciar sesión después del registro (opcional)

class RegisterController extends Controller
{
    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Apuntará a resources/views/auth/register.blade.php
    }

    /**
     * Maneja el registro de un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // 1. Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' busca un campo 'password_confirmation'
        ]);

        // 2. Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Opcional: Iniciar sesión al usuario inmediatamente después del registro
        Auth::login($user);

        // 4. Redirigir al usuario
        return redirect()->route('users.index')->with('success', '¡Registro exitoso! Sesión iniciada.');
        // Puedes redirigir a donde quieras, por ejemplo, al dashboard o a la lista de usuarios.
    }
}
