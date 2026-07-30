<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\Publicacion;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInscripciones = Inscripcion::count();
        $pendientes = Inscripcion::where('estado', 'pendiente')->count();
        $contactados = Inscripcion::where('estado', 'contactado')->count();
        $matriculados = Inscripcion::where('estado', 'matriculado')->count();
        $totalPublicaciones = Publicacion::count();

        return view('admin.dashboard', compact('totalInscripciones', 'pendientes', 'contactados', 'matriculados', 'totalPublicaciones'));
    }
}