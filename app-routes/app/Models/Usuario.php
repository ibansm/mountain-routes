<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['username','nombre', 'apellidos', 'email', 'edad', 'password'];

    public function usuarios() { // Un usuario puede tener muchas rutas
        return $this->hasMany(Ruta::class, 'usuarios_id');
    }
}
