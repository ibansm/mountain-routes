<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'historicos_id',
        'tipo',
        'coordenada',
        'estado'
    ];

    public function historicos() { // Las incidencias pertenecen a un solo historico
        return $this->belongsTo(Historico::class);
    }
}
