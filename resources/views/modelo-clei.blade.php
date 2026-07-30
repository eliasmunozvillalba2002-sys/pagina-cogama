@extends('layouts.public')

@section('title', 'Modelo CLEI')
@section('meta_description', 'Descubre cómo funciona el modelo CLEI del Colegio Gabriel García Márquez para avanzar más rápido y terminar el bachillerato los domingos.')

@section('content')

<section class="bg-blue-950 text-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <p class="uppercase tracking-widest text-blue-300 text-sm font-semibold mb-3">Modelo educativo</p>
        <h1 class="text-2xl md:text-3xl font-bold">¿Qué es el CLEI?</h1>
        <p class="text-blue-200 mt-4 max-w-xl mx-auto">
            El CLEI (Ciclo Lectivo Especial Integrado) agrupa varios grados en un solo ciclo,
            así avanzas más rápido que en el bachillerato tradicional — ideal para adultos
            que ya tienen experiencia de vida y quieren terminar sus estudios sin perder tiempo.
        </p>
    </div>
</section>

<section class="max-w-4xl mx-auto px-6 py-16">

    <h2 class="text-2xl font-bold text-slate-800 mb-8 text-center">Equivalencias</h2>

    <div class="grid sm:grid-cols-2 gap-6 mb-16">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
            <p class="text-3xl font-bold text-blue-800 mb-1">CLEI 3</p>
            <p class="text-slate-600 text-sm">Equivale a 6° y 7°</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
            <p class="text-3xl font-bold text-blue-800 mb-1">CLEI 4</p>
            <p class="text-slate-600 text-sm">Equivale a 8° y 9°</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
            <p class="text-3xl font-bold text-blue-800 mb-1">CLEI 5</p>
            <p class="text-slate-600 text-sm">Equivale a 10°</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
            <p class="text-3xl font-bold text-blue-800 mb-1">CLEI 6</p>
            <p class="text-slate-600 text-sm">Equivale a 11°</p>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-slate-800 mb-6 text-center">¿Cómo funciona la metodología?</h2>

    <div class="grid md:grid-cols-3 gap-8 text-center">
        <div>
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">📅</div>
            <h3 class="font-semibold text-lg mb-2">Fines de semana</h3>
            <p class="text-slate-600 text-sm">Clases los domingos, para no afectar tu trabajo entre semana.</p>
        </div>
        <div>
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">📘</div>
            <h3 class="font-semibold text-lg mb-2">Guías de estudio</h3>
            <p class="text-slate-600 text-sm">Trabajas con guías diseñadas para adultos, a tu propio ritmo.</p>
        </div>
        <div>
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">🎓</div>
            <h3 class="font-semibold text-lg mb-2">Avance por ciclos</h3>
            <p class="text-slate-600 text-sm">Cada ciclo aprobado te acerca directamente a tu título de bachiller.</p>
        </div>
    </div>

    <div class="text-center mt-16">
        <a href="{{ route('inscripcion.formulario') }}"
           class="inline-block bg-blue-800 hover:bg-blue-900 text-white font-bold px-10 py-4 rounded-lg shadow-md transition">
            Quiero inscribirme
        </a>
    </div>

</section>

@endsection