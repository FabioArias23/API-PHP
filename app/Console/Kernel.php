<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportarProvincias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:provincias'; // <--- ¡Asegúrate de que sea exactamente esto!

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa datos de provincias a la base de datos.'; // Una descripción útil

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Tu lógica de importación va aquí
        $this->info('Importando provincias...');
        // ...
        $this->info('Provincias importadas correctamente.');
        return Command::SUCCESS;
    }
}
