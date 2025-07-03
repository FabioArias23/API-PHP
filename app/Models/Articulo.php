<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $precio
 * @property int $categoria_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categoria $categoria
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Articulo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Articulo extends Model
{
protected $fillable = ['nombre','descripcion','precio','categoria_id'];
public function categoria() {
return $this->belongsTo(Categoria::class);
}

}
