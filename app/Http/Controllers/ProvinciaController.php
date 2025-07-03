<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Provincia;
use Illuminate\Http\Request; // Asegúrate de tener este use si lo usas, si no, puedes quitarlo

class ProvinciaController extends Controller
{
    /**
     * Importa provincias desde la API y las almacena en la base de datos.
     * Este método se suele llamar mediante un comando de Artisan o una ruta de administración.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function importar()
    {
        try {
            $response = Http::get('https://apis.datos.gob.ar/georef/api/provincias?campos=id,nombre');

            if ($response->successful()) {
                $provincias = $response->json()['provincias'];

                foreach ($provincias as $provinciaData) {
                    // Generar o asignar la URL de la imagen
                    // Aquí es donde llamas al método que debe existir en esta clase
            $imageUrl = 'https://upload.wikimedia.org/wikipedia/commons/4/42/Bandera_de_la_Provincia_de_Formosa.svg';

                    Provincia::updateOrCreate(
                        ['id' => $provinciaData['id']],
                        [
                            'nombre' => $provinciaData['nombre'],
                            'pathimage' => $imageUrl, // <-- Aquí asignas la URL de la imagen
                        ]
                    );
                }
                return response()->json(['message' => 'Provincias importadas correctamente.'], 200);
            } else {
                return response()->json(['error' => 'No se pudo obtener la información de la API.'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al importar las provincias: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Muestra un listado de las provincias en una vista de Blade.
     * Las provincias se pueden obtener de la base de datos o directamente de la API.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            // Opción 1 (Recomendada): Obtener las provincias desde tu base de datos.
            $provincias = Provincia::all();

            // Pasa las provincias a tu vista de Blade.
            return view('provincias.index', compact('provincias'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al mostrar las provincias: ' . $e->getMessage());
        }
    }

    /**
     * Función auxiliar para obtener la URL de la imagen de una provincia.
     * IMPORTANTE: Esta es una lógica de ejemplo. Debes adaptar cómo obtienes las URLs.
     *
     * @param string $nombreProvincia El nombre de la provincia.
     * @return string|null La URL de la imagen o null si no se encuentra.
     */
    private function getProvinciaImageUrl(string $nombreProvincia): ?string
    {
        // --- OPCIÓN 1: Mapeo manual de nombres de provincia a URLs ---
        // Si tienes un conjunto fijo y pequeño de provincias y sus imágenes.
        $images = [
            'Buenos Aires' => 'https://acdn-us.mitiendanube.com/stores/002/822/878/products/mapa-politico-buenos-aires-canvas-1-ebf0b5f8c1ba9bf9ac17024059831104-1024-1024.jpg',
            'Córdoba' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Bandera_de_la_provincia_de_C%C3%B3rdoba_%28Argentina%29.svg/800px-Bandera_de_la_provincia_de_C%C3%B3rdoba_%28Argentina%29.svg.png',
            'Santa Fe' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Bandera_de_la_provincia_de_Santa_Fe.svg/800px-Bandera_de_la_provincia_de_Santa_Fe.svg.png',
            'Formosa' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Bandera_de_la_provincia_de_Formosa.svg/800px-Bandera_de_la_provincia_de_Formosa.svg.png',
            'Misiones' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Bandera_de_la_provincia_de_Misiones.svg/800px-Bandera_de_la_provincia_de_Misiones.svg.png',
            'Salta' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/Bandera_de_la_provincia_de_Salta.svg/800px-Bandera_de_la_provincia_de_Salta.svg.png',
            'Jujuy' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Bandera_de_la_provincia_de_Jujuy.svg/800px-Bandera_de_la_provincia_de_Jujuy.svg.png',
            'Tucumán' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Flag_of_Tucum%C3%A1n_Province.svg/800px-Flag_of_Tucum%C3%A1n_Province.svg.png',
            'Santiago del Estero' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Bandera_de_la_Provincia_de_Santiago_del_Estero.svg/800px-Bandera_de_la_Provincia_de_Santiago_del_Estero.svg.png',
            'Catamarca' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Flag_of_Catamarca_Province.svg/800px-Flag_of_Catamarca_Province.svg.png',
            'La Rioja' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Flag_of_La_Rioja_%28Argentina%29.svg/800px-Flag_of_La_Rioja_%28Argentina%29.svg.png',
            'San Juan' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Bandera_de_la_provincia_de_San_Juan.svg/800px-Bandera_de_la_provincia_de_San_Juan.svg.png',
            'San Luis' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Bandera_de_la_Provincia_de_San_Luis_%28Argentina%29.svg/800px-Bandera_de_la_Provincia_de_San_Luis_%28Argentina%29.svg.png',
            'Mendoza' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Bandera_de_la_provincia_de_Mendoza.svg/800px-Bandera_de_la_provincia_de_Mendoza.svg.png',
            'La Pampa' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Bandera_de_La_Pampa.svg/800px-Bandera_de_La_Pampa.svg.png',
            'Neuquén' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Bandera_de_la_provincia_del_Neuqu%C3%A9n.svg/800px-Bandera_de_la_provincia_del_Neuqu%C3%A9n.svg.png',
            'Río Negro' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Bandera_de_la_provincia_de_R%C3%ADo_Negro.svg/800px-Bandera_de_la_provincia_de_R%C3%ADo_Negro.svg.png',
            'Chubut' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Bandera_de_la_provincia_del_Chubut.svg/800px-Bandera_de_la_provincia_del_Chubut.svg.png',
            'Santa Cruz' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Bandera_de_Santa_Cruz_%28Argentina%29.svg/800px-Bandera_de_Santa_Cruz_%28Argentina%29.svg.png',
            'Tierra del Fuego' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Bandera_de_Tierra_del_Fuego%2C_Ant%C3%A1rtida_e_Islas_del_Atl%C3%A1ntico_Sur.svg/800px-Bandera_de_Tierra_del_Fuego%2C_Ant%C3%A1rtida_e_Islas_del_Atl%C3%A1ntico_Sur.svg.png',
            'Corrientes' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Bandera_de_la_provincia_de_Corrientes.svg/800px-Bandera_de_la_provincia_de_Corrientes.svg.png',
            'Entre Ríos' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Bandera_de_la_provincia_de_Entre_R%C3%ADos.svg/800px-Bandera_de_la_provincia_de_Entre_R%C3%ADos.svg.png',
            'Chaco' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Bandera_de_la_provincia_del_Chaco.svg/800px-Bandera_de_la_provincia_del_Chaco.svg.png',
        ];

        // Normaliza el nombre si es necesario para que coincida con tus claves en $images
        // Por ejemplo, si los nombres de la API tienen tildes y tus claves no, o viceversa.
        // Aquí dejo el nombre tal cual para que coincida con las claves exactas de arriba.
        // $nombreNormalizado = Str::slug($nombreProvincia); // Si usas Str (requiere use Illuminate\Support\Str;)

        return $images[$nombreProvincia] ?? null; // Retorna la URL o null si no se encuentra
    }

    // --- OPCIÓN 2: Construir la URL de la imagen basada en el nombre (si tienes un patrón) ---
    /*
    private function getProvinciaImageUrl(string $nombreProvincia): ?string
    {
        // Ejemplo: Si tus imágenes están en public/images/provincias/buenos-aires.jpg
        // Necesitarías slugs (versiones amigables para URL) de los nombres.
        // Necesitarás 'use Illuminate\Support\Str;' al principio del archivo.
        $slug = Str::slug($nombreProvincia); // Convierte "Buenos Aires" a "buenos-aires"
        $path = asset('images/provincias/' . $slug . '.jpg'); // Usa asset() para URLs públicas
        // Debes asegurarte que las imágenes existan en esa ruta.

        // Puedes verificar si el archivo existe en el sistema de archivos
        // use Illuminate\Support\Facades\File;
        // if (File::exists(public_path('images/provincias/' . $slug . '.jpg'))) {
        //     return $path;
        // }
        // return null;

        return $path; // Esto asume que la imagen siempre existirá
    }
    */
}
