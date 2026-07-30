@extends('layouts.public')

@section('title', 'Quiénes somos')
@section('meta_description', 'Conoce la identidad institucional del Colegio Gabriel García Márquez, su misión, visión, filosofía y el propósito educativo del colegio.')

@section('content')

<section class="bg-blue-950 text-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <p class="uppercase tracking-widest text-blue-300 text-sm font-semibold mb-3">Quiénes somos</p>
        <h1 class="text-2xl md:text-3xl font-bold">
            {{ $contenido['lema'] ?? 'Comprometidos con la educación de jóvenes y adultos' }}
        </h1>
    </div>
</section>

<section class="max-w-4xl mx-auto px-6 py-16 space-y-12">

    <section class="bg-slate-50 rounded-2xl border border-slate-200 p-8 md:p-10">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">Identidad institucional</h2>
                <p class="text-slate-600 leading-relaxed">
                    Aquí se concentran los símbolos, el himno y la parte legal del colegio para que la comunidad los reconozca y tenga acceso a la información institucional.
                </p>
            </div>
            <div class="flex-1 grid sm:grid-cols-2 gap-6 w-full">
                @if(!empty($contenido['bandera_imagen']))
                    <div class="bg-white rounded-xl border border-slate-200 p-4">
                        <h3 class="font-semibold text-slate-800 mb-3">Bandera</h3>
                        <img src="{{ $contenido['bandera_imagen'] }}" alt="Bandera del colegio" class="w-full h-40 object-contain rounded-lg">
                    </div>
                @endif
                @if(!empty($contenido['escudo_imagen']))
                    <div class="bg-white rounded-xl border border-slate-200 p-4">
                        <h3 class="font-semibold text-slate-800 mb-3">Escudo</h3>
                        <img src="{{ $contenido['escudo_imagen'] }}" alt="Escudo del colegio" class="w-full h-40 object-contain rounded-lg">
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-8 grid lg:grid-cols-2 gap-6">
            @if(!empty($contenido['himno_texto']))
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <h3 class="font-semibold text-slate-800 mb-3">Himno institucional</h3>
                    <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $contenido['himno_texto'] }}</p>
                </div>
            @endif
            @if(!empty($contenido['parte_legal']))
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <h3 class="font-semibold text-slate-800 mb-3">Parte legal y resoluciones</h3>
                    <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $contenido['parte_legal'] }}</p>
                </div>
            @endif
        </div>

        @if(empty($contenido['bandera_imagen']) && empty($contenido['escudo_imagen']) && empty($contenido['himno_texto']) && empty($contenido['parte_legal']))
            <div class="mt-6 rounded-xl border border-dashed border-slate-300 bg-white p-6 text-sm text-slate-500">
                Aún no se han cargado los símbolos, himno o parte legal del colegio. Puedes agregarlos desde el panel administrativo.
            </div>
        @endif
    </section>

    @if(!empty($contenido['mision']))
    <div>
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Misión</h2>
        <p class="text-slate-600 leading-relaxed">{{ $contenido['mision'] }}</p>
    </div>
    @endif

    @if(!empty($contenido['vision']))
    <div>
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Visión</h2>
        <p class="text-slate-600 leading-relaxed">{{ $contenido['vision'] }}</p>
    </div>
    @endif
@if(!empty($contenido['filosofia']))
    <div>
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Filosofía</h2>
        <p class="text-slate-600 leading-relaxed">{{ $contenido['filosofia'] }}</p>
    </div>
    @endif

    @if(!empty($contenido['politica_calidad']))
    <div>
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Política de Calidad</h2>
        <p class="text-slate-600 leading-relaxed">{{ $contenido['politica_calidad'] }}</p>
    </div>
    @endif

    @if(!empty($contenido['perfil_estudiante']))
    <div>
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Perfil del Estudiante</h2>
        <p class="text-slate-600 leading-relaxed">{{ $contenido['perfil_estudiante'] }}</p>
    </div>
    @endif
</section>

@endsection