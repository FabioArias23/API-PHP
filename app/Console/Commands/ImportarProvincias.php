<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Provincia;

class ImportarProvincias extends Command
{
    protected $signature = 'importar:provincias';
    protected $description = 'Importa provincias desde la API de datos.gob.ar y las guarda en la base de datos';
    protected $commands = [
 \App\Console\Commands\ImportarProvincias::class,
];

    public function handle()
    {
        $this->info('Importando provincias...');
        $response =
            Http::get('https://apis.datos.gob.ar/georef/api/provincias?campos=id,nombre');
        if ($response->successful()) {
            $provincias = $response->json()['provincias'];
            foreach ($provincias as $provincia) {
                Provincia::updateOrCreate(
                    ['id' => $provincia['id']],
                    ['nombre' => $provincia['nombre']]
                );
            }
            $this->info('Provincias importadas correctamente.');
        } else {
            $this->error('Error al obtener las provincias.');
        }
    }
}
