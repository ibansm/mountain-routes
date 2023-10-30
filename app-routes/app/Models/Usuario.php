<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected function name(): Attribute {
        return new Attribute(
           set: function($value) {
            return strtolower($value);
           }
        );

    }
}
