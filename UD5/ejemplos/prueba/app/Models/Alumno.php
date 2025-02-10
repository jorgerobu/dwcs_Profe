<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Alumno extends Model
{
    public $timestamps = false;

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class)->withDefault(['nombre'=>'EMPTY','id'=>-1]);
    }

    public function materias():BelongsToMany{
        return $this->belongsToMany(Materia::class);
    }
}
