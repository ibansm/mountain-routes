<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'rutas_id',
        'fecha_actualizada',
        'fecha_realizada'
    ];

    public function rutas() { // Las fotos pertenecen a una sola ruta
        return $this->belongsTo(Ruta::class);
    }

    public function incidencias () {
        return $this->hasMany(Incidencia::class, 'historicos_id');
    }
}
