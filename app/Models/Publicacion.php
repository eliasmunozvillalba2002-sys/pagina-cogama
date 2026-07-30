<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';

    protected $fillable = [
        'tipo',
        'titulo',
        'contenido',
        'imagen',
        'publicado',
        'fecha_publicacion',
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'fecha_publicacion' => 'datetime',
    ];
}