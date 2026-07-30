@extends('layouts.admin')

@section('title', 'Inicio')

@section('content')

<div class="grid md:grid-cols-4 gap-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <p class="text-sm text-slate-500 mb-1">Inscripciones (vía plataforma)</p>
        <p class="text-3xl font-bold text-blue-900">{{ $totalInscripciones }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <p class="text-sm text-slate-500 mb-1">Pendientes</p>
        <p class="text-3xl font-bold text-yellow-600">{{ $pendientes }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <p class="text-sm text-slate-500 mb-1">Contactados</p>
        <p class="text-3xl font-bold text-blue-700">{{ $contactados }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <p class="text-sm text-slate-500 mb-1">Matriculados</p>
        <p class="text-3xl font-bold text-green-700">{{ $matriculados }}</p>
    </div>
</div>

<div class="mt-10 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <p class="text-slate-600 text-sm">
        Bienvenido al panel de COGAMA. Desde el menú de la izquierda puedes gestionar notas, docentes, publicaciones, inscripciones y el contenido de la página pública.
    </p>
</div>

@endsection