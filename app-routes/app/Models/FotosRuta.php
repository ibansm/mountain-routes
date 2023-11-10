<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class FotosRuta extends Model
{
    use HasFactory;

    protected $table = "fotos_ruta";

    protected $fillable = [
        'nombre',
        'data',
        'coordenadas',
        'rutas_id'
    ];

    protected function coordenadas(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }

    public function rutas() { // Las fotos pertenecen a una sola ruta
        return $this->belongsTo(Ruta::class);
    }
}
