<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Historico;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion',
        'coordenada',
        'estado',
        'rutas_id',
        'historicos_id'
    ];

    public function historicos() { // Las incidencias pertenecen a un solo historico
        return $this->belongsTo(Historico::class);
    }
}
