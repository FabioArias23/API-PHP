<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('provincias', function (Blueprint $table) {
            $table->string('pathimage')->nullable()->after('nombre'); // <-- Añade esta línea
            // `->nullable()` permite que la columna esté vacía.
            // `->after('nombre')` es opcional, la coloca después de la columna 'nombre'.
        });
    }

    public function down(): void
    {
        Schema::table('provincias', function (Blueprint $table) {
            $table->dropColumn('pathimage'); // <-- Elimina la columna al revertir
        });
    }
};
