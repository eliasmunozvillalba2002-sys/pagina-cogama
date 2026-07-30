<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'telefono',
        'email',
        'ciclo_interes_id',
        'mensaje',
        'estado',
    ];

    public function cicloInteres()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_interes_id');
    }
}