<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Para el sistema de autenticación de Laravel

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Apuntará a resources/views/auth/login.blade.php
    }

    /**
     * Maneja la solicitud de login del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 1. Validación de los datos
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Intentar autenticar al usuario
        // Auth::attempt intenta iniciar sesión al usuario basándose en las credenciales.
        // El segundo argumento (false en este caso) indica si recordar la sesión ('remember me').
        if (Auth::attempt($credentials, false)) {
            // Regenerar la sesión para prevenir "session fixation attacks"
            $request->session()->regenerate();

            // Redirigir al usuario a una página después del login exitoso
            return redirect()->intended(route('users.index'))->with('success', '¡Has iniciado sesión correctamente!');
            // `intended()` redirige a la URL a la que el usuario intentaba acceder antes de ser redirigido al login,
            // o a la ruta por defecto ('users.index' en este caso) si no hay URL intencionada.
        }

        // Si la autenticación falla, redirigir de vuelta al formulario de login con un error.
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email'); // Solo mantener el email ingresado
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión del usuario

        // Invalida la sesión actual
        $request->session()->invalidate();

        // Regenera el token CSRF para una nueva sesión
        $request->session()->regenerateToken();

        // Redirige al usuario a la página de inicio o a donde desees después del logout
        return redirect('/')->with('success', 'Has cerrado sesión.');
    }
}
