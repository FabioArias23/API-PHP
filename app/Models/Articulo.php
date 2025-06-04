<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
protected $fillable = ['nombre','descripcion','precio','categoria_id'];
public function categoria() {
return $this->belongsTo(Categoria::class);
}

}
