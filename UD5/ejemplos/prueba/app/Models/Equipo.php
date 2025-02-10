<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    public function alumnos(): HasMany{
        return $this->hasMany(Alumno::class);
    }
}
