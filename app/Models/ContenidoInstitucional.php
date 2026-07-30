<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenidoInstitucional extends Model
{
    use HasFactory;

    protected $table = 'contenido_institucional';

    protected $fillable = ['clave', 'valor'];
}