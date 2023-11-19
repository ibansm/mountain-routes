<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'id',
        'fecha_actualizada',
        'fecha_realizada'
    ];

    public function incidencias () {
        return $this->hasMany(Incidencia::class, 'historicos_id');
    }
}
