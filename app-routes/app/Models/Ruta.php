<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = [
            'nombre',
            'descripcion',
            'longitud',
            'tiempo',
            'ciudad',
            'fecha_creada',
            'fecha_realizada',
            'coordenadas',
            'dificultad',
            'foto_perfil',
            'usuarios_id',
        ];

    protected function coordenadas(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }

    public function usuarios() { // Una ruta pertenece a un solo usuario
        return $this->belongsTo(Usuario::class);
    }

    public function fotos() { // Una ruta puede tener muchas fotos
        return $this->hasMany(FotosRuta::class, 'rutas_id');
    }

}
