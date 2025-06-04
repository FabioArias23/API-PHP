<?php

namespace App\Http\Controllers; // Este es el namespace para controladores web

use App\Http\Controllers\Controller;
use App\Models\Cliente; // Importa tu modelo Cliente
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Necesario para capturar errores de validación
// Ya no necesitamos 'use Illuminate\Database\Eloquent\ModelNotFoundException;'

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
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     * GET /clientes/create
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
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
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:clientes,email',
                'telefono' => 'nullable|string|max:20',
                'dni' => 'required|string|max:10|unique:clientes,dni',
                // 'direccion' ya no está aquí
            ]);

            Cliente::create($request->all());

            return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el cliente: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Muestra los detalles de un cliente específico.
     * GET /clientes/{cliente}
     *
     * @param  string  $id El ID del cliente.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(string $id)
    {
        // Ya no se usa try-catch para ModelNotFoundException aquí.
        // Si el cliente no existe, Laravel lanzará una excepción genérica 404.
        $cliente = Cliente::findOrFail($id); // findOrFail directamente
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Muestra el formulario para editar un cliente existente.
     * GET /clientes/{cliente}/edit
     *
     * @param  string  $id El ID del cliente a editar.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(string $id)
    {
        // Ya no se usa try-catch para ModelNotFoundException aquí.
        // Si el cliente no existe, Laravel lanzará una excepción genérica 404.
        $cliente = Cliente::findOrFail($id); // findOrFail directamente
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualiza un cliente existente en la base de datos.
     * PUT/PATCH /clientes/{cliente}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id El ID del cliente a actualizar.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        // Ya no se usa try-catch para ModelNotFoundException aquí.
        $cliente = Cliente::findOrFail($id); // findOrFail directamente

        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:clientes,email,' . $cliente->id,
                'telefono' => 'nullable|string|max:20',
                'dni' => 'required|string|max:10|unique:clientes,dni,' . $cliente->id,
                // 'direccion' ya no está aquí
            ]);

            $cliente->update($request->all());

            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el cliente: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Elimina un cliente de la base de datos.
     * DELETE /clientes/{cliente}
     *
     * @param  string  $id El ID del cliente a eliminar.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        // Ya no se usa try-catch para ModelNotFoundException aquí.
        $cliente = Cliente::findOrFail($id); // findOrFail directamente
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
