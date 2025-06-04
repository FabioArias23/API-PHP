<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Necesario para usar las fábricas de modelos
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory; // Permite usar Cliente::factory()->create() para datos de prueba

    /**
     * El nombre de la tabla asociada con el modelo.
     * Por defecto, Laravel pluraliza el nombre del modelo. Aquí lo hacemos explícito.
     * @var string
     */
    protected $table = 'clientes';

    /**
     * La clave primaria de la tabla.
     * Por defecto, Laravel asume 'id'.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indica si el modelo debe registrar timestamps (created_at, updated_at).
     * @var bool
     */
    public $timestamps = true; // Si tienes created_at y updated_at en tu tabla, déjalo en true. Si no, ponlo en false.
    protected $fillable = [
        'nombre',
        'dni',
        'email',
        'telefono',

    ];


}
