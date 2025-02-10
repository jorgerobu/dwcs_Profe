<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Materia extends Model
{
    public function alumnos():BelongsToMany{
        return $this->belongsToMany(Alumno::class);
    }
}
