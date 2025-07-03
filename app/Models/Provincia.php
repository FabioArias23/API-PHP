<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $pathimage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia wherePathimage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Provincia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',       // Si realmente necesitas asignar el ID manualmente (ej. si viene de una API)
        'nombre',
        'pathimage',
        // Agrega aquí otras columnas que recibas de la API, por ejemplo 'codigo'
    ];

    // Opcional: Si el ID es autoincremental en la BD y no lo quieres asignar manualmente
    // protected $fillable = [
    //     'nombre',
    //     // 'codigo',
    // ];
    // En este caso, no intentarías asignar 'id' al crear la provincia

    // Si tu tabla no usa la convención de 'id' como clave primaria autoincremental,
    // o si el campo 'id' viene de la API y lo usas como clave primaria,
    // entonces asegúrate de que $incrementing sea false si no es autoincremental
    // public $incrementing = false;
    // protected $keyType = 'string'; // Si el ID de la API es un string
}
