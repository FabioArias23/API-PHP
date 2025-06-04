<?php

namespace App\Http\Controllers; // Este es el namespace para controladores web

use App\Http\Controllers\Controller;
use App\Models\Cliente; // Importa tu modelo Cliente
use Illuminate\Http\Request;

class ClienteWebController extends Controller
{
    /**
     * Muestra la vista con la lista de clientes desde la base de datos.
     * GET /clientes
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener todos los clientes de la base de datos usando el modelo Cliente
        $clientes = Cliente::all(); // Esto traerá todos los clientes de tu tabla 'clientes'

        // Pasar los clientes a la vista 'clientes.index'
        // 'clientes.index' se refiere a 'resources/views/clientes/index.blade.php'
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     * GET /clientes/crear
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Simplemente devuelve la vista del formulario, no necesita pasar datos por ahora
        return view('clientes.create');
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     * POST /clientes
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255', // Asumo que tienes apellido, etc.
            'email' => 'required|string|email|max:255|unique:clientes,email',
            'telefono' => 'nullable|string|max:20',
            'dni' => 'required|string|max:10|unique:clientes,dni',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente!');
    }
  public function show(string $id)
    {
        try {
            // Busca el cliente por su ID. Si no lo encuentra, lanza ModelNotFoundException.
            $cliente = Cliente::findOrFail($id);

            // Devuelve la vista 'clientes.show' y le pasa el cliente.
            // ¡Recuerda crear el archivo resources/views/clientes/show.blade.php!
            return view('clientes.show', compact('cliente'));
        } catch (\Exception $e) {
            // Captura cualquier otro error inesperado.
            return redirect()->route('clientes.index')->with('error', 'Ocurrió un error al cargar los detalles del cliente.');
        }
    }
    // Aquí puedes añadir otros métodos como show, edit, update, destroy si los necesitas para la web
}
