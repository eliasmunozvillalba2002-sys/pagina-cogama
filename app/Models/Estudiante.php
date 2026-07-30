<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento',
        'nombres',
        'apellidos',
        'ciclo_id',
        'telefono',
        'email',
        'estado',
    ];

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}