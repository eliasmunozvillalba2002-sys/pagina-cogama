<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'inicio'])->name('inicio');
Route::get('/quienes-somos', [PublicController::class, 'quienesSomos'])->name('quienes-somos');
Route::get('/docentes', [PublicController::class, 'docentes'])->name('docentes.publico');
Route::get('/modelo-clei', [PublicController::class, 'modeloClei'])->name('modelo-clei');
Route::get('/contacto', [PublicController::class, 'contacto'])->name('contacto');
Route::get('/inscripcion', [App\Http\Controllers\InscripcionController::class, 'formulario'])->name('inscripcion.formulario');
Route::post('/inscripcion', [App\Http\Controllers\InscripcionController::class, 'store'])->name('inscripcion.store');
Route::get('/galeria', [App\Http\Controllers\PublicController::class, 'galeria'])->name('galeria');
Route::get('/carrusel', [App\Http\Controllers\PublicController::class, 'carruselPage'])->name('carrusel');

Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/contenido', [App\Http\Controllers\Admin\ContenidoController::class, 'edit'])->name('contenido.edit');
    Route::put('/contenido', [App\Http\Controllers\Admin\ContenidoController::class, 'update'])->name('contenido.update');

    Route::get('/publicaciones', [App\Http\Controllers\Admin\PublicacionController::class, 'index'])->name('publicaciones.index');
    Route::get('/publicaciones/nueva', [App\Http\Controllers\Admin\PublicacionController::class, 'create'])->name('publicaciones.create');
    Route::post('/publicaciones', [App\Http\Controllers\Admin\PublicacionController::class, 'store'])->name('publicaciones.store');
    Route::get('/publicaciones/{publicacione}/editar', [App\Http\Controllers\Admin\PublicacionController::class, 'edit'])->name('publicaciones.edit');
    Route::put('/publicaciones/{publicacione}', [App\Http\Controllers\Admin\PublicacionController::class, 'update'])->name('publicaciones.update');
    Route::delete('/publicaciones/{publicacione}', [App\Http\Controllers\Admin\PublicacionController::class, 'destroy'])->name('publicaciones.destroy');

    Route::get('/galeria', [App\Http\Controllers\Admin\GaleriaController::class, 'index'])->name('galeria.index');
    Route::get('/galeria/nueva', [App\Http\Controllers\Admin\GaleriaController::class, 'create'])->name('galeria.create');
    Route::post('/galeria', [App\Http\Controllers\Admin\GaleriaController::class, 'store'])->name('galeria.store');
    Route::delete('/galeria/{galeria}', [App\Http\Controllers\Admin\GaleriaController::class, 'destroy'])->name('galeria.destroy');

    // Carrusel admin CRUD
    Route::get('/carrusel', [App\Http\Controllers\Admin\CarruselController::class, 'index'])->name('carrusel.index');
    Route::get('/carrusel/nuevo', [App\Http\Controllers\Admin\CarruselController::class, 'create'])->name('carrusel.create');
    Route::post('/carrusel', [App\Http\Controllers\Admin\CarruselController::class, 'store'])->name('carrusel.store');
    Route::get('/carrusel/{carrusel}/editar', [App\Http\Controllers\Admin\CarruselController::class, 'edit'])->name('carrusel.edit');
    Route::put('/carrusel/{carrusel}', [App\Http\Controllers\Admin\CarruselController::class, 'update'])->name('carrusel.update');
    Route::delete('/carrusel/{carrusel}', [App\Http\Controllers\Admin\CarruselController::class, 'destroy'])->name('carrusel.destroy');

    Route::get('/docentes', [App\Http\Controllers\Admin\DocenteController::class, 'index'])->name('docentes.index');
    Route::get('/docentes/nuevo', [App\Http\Controllers\Admin\DocenteController::class, 'create'])->name('docentes.create');
    Route::post('/docentes', [App\Http\Controllers\Admin\DocenteController::class, 'store'])->name('docentes.store');
    Route::get('/docentes/{docente}/editar', [App\Http\Controllers\Admin\DocenteController::class, 'edit'])->name('docentes.edit');
    Route::put('/docentes/{docente}', [App\Http\Controllers\Admin\DocenteController::class, 'update'])->name('docentes.update');
    Route::delete('/docentes/{docente}', [App\Http\Controllers\Admin\DocenteController::class, 'destroy'])->name('docentes.destroy');
    Route::get('/inscripciones', [App\Http\Controllers\Admin\InscripcionController::class, 'index'])->name('inscripciones.index');
    Route::patch('/inscripciones/{inscripcion}/contactado', [App\Http\Controllers\Admin\InscripcionController::class, 'marcarContactado'])->name('inscripciones.contactado');
    Route::patch('/inscripciones/{inscripcion}/matriculado', [App\Http\Controllers\Admin\InscripcionController::class, 'marcarMatriculado'])->name('inscripciones.matriculado');
    Route::delete('/inscripciones/{inscripcion}', [App\Http\Controllers\Admin\InscripcionController::class, 'destroy'])->name('inscripciones.destroy');
   
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';