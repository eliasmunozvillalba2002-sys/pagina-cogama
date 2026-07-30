<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudiante_id',
        'ciclo_id',
        'asignatura_id',
        'periodo',
        'nota',
        'observaciones',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }
}