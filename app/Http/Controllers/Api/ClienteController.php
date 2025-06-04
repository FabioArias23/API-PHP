<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Validation\ValidationException; // Para manejar errores de validación
use Illuminate\Database\Eloquent\ModelNotFoundException; // Para manejar clientes no encontrados

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de todos los clientes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

            $clientes = Cliente::all(); // Obtiene todos los clientes
            return response()->json([
                'message' => 'Lista de clientes obtenida exitosamente.',
                'data' => $clientes
            ]);
    }


    public function store(Request $request)
    {
        try {
            // 1. Validar los datos de entrada
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:clientes,email',
                'telefono' => 'nullable|string|max:20',
                'dni' => 'required|string|max:10|unique:clientes,dni',

            ]);

            // 2. Crear el nuevo cliente utilizando los datos validados
            $cliente = Cliente::create($validatedData);

            // 3. Devolver una respuesta JSON exitosa
            return response()->json([
                'message' => 'Cliente creado exitosamente.',
                'data' => $cliente
            ], 201); // se creo pues

        } catch (\Exception $e) {
            // Captura cualquier otro error
            return response()->json([
                'message' => 'Error al crear el cliente.',
                'error' => $e->getMessage()
            ], 500); // Código 500 Internal Server Error
        }
    }


    public function show(string $id)
    {
        try {
            // Busca el cliente por su ID. Si no lo encuentra, lanza ModelNotFoundException.
            $cliente = Cliente::findOrFail($id);

            return response()->json([
                'message' => 'Cliente encontrado exitosamente.',
                'data' => $cliente
            ], 200); // Código 200 OK
        } catch (ModelNotFoundException $e) {
            // Captura si el cliente no fue encontrado
            return response()->json([
                'message' => 'Cliente no encontrado.',
                'error' => 'El cliente con el ID proporcionado no existe.'
            ], 404); // Código 404 Not Found
        } catch (\Exception $e) {
            // Captura cualquier otro error
            return response()->json([
                'message' => 'Error al buscar el cliente.',
                'error' => $e->getMessage()
            ], 500); // Código 500 Internal Server Error
        }
    }


    public function update(Request $request, string $id)
    {
        try {
            // Busca el cliente por su ID. Si no lo encuentra, lanza ModelNotFoundException.
            $cliente = Cliente::findOrFail($id);

            // 1. Validar los datos de entrada
            $validatedData = $request->validate([
                'nombre' => 'sometimes|required|string|max:255', // 'sometimes' valida solo si el campo está presente
                'apellido' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:clientes,email,' . $cliente->id,
                'telefono' => 'nullable|string|max:20',

            ]);

            // 2. Actualizar el cliente con los datos validados
            $cliente->update($validatedData);

            // 3. Devolver una respuesta JSON exitosa
            return response()->json([
                'message' => 'Cliente actualizado exitosamente.',
                'data' => $cliente
            ], 200); // Código 200 OK
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Cliente no encontrado para actualizar.',
                'error' => 'El cliente con el ID proporcionado no existe.'
            ], 404); // Código 404 Not Found
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación al actualizar.',
                'errors' => $e->errors()
            ], 422); // Código 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el cliente.',
                'error' => $e->getMessage()
            ], 500); // Código 500 Internal Server Error
        }
    }


    public function destroy(string $id)
    {
        try {
            // Busca el cliente por su ID. Si no lo encuentra, lanza ModelNotFoundException.
            $cliente = Cliente::findOrFail($id);

            // Elimina el cliente
            $cliente->delete();

            // Devolver una respuesta JSON exitosa sin contenido (No Content)
            return response()->json([
                'message' => 'Cliente eliminado exitosamente.'
            ], 204); // Código 204 No Content
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Cliente no encontrado para eliminar.',
                'error' => 'El cliente con el ID proporcionado no existe.'
            ], 404); // Código 404 Not Found
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el cliente.',
                'error' => $e->getMessage()
            ], 500); // Código 500 Internal Server Error
        }
    }
}
