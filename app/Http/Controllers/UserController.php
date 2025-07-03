<?php

namespace App\Http\Controllers;

use App\Models\User; // Importa el modelo User
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios de la base de datos
        // Puedes paginar si tienes muchos usuarios para mejor rendimiento:
        // $users = User::paginate(10);
        $users = User::all(); // Esto obtiene todos los usuarios

        // Pasar los usuarios a la vista
        return view('users.index', compact('users'));
    }

    // Aquí podrías añadir otros métodos como create, store, edit, update, destroy
}
