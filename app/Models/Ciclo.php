<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'equivalencia', 'descripcion'];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}