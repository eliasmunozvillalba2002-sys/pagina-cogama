@extends('layouts.public')

@section('title', 'Inicio')
@section('meta_description', 'COGAMA ofrece educación para jóvenes y adultos trabajadores con clases los domingos, modelo CLEI y procesos de inscripción claros para terminar el bachillerato.')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden text-white @if(!empty($contenido['imagen_portada'])) bg-slate-900 @else bg-gradient-to-br from-blue-900 via-blue-700 to-red-700 @endif">
    @if(!empty($contenido['imagen_portada']))
        <div class="absolute inset-0" style="background-image: linear-gradient(120deg, rgba(30,58,138,0.82), rgba(185,28,28,0.72)), url('{{ $contenido['imagen_portada'] }}'); background-size: cover; background-position: center;"></div>
    @else
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(250,204,21,0.30),_transparent_35%),radial-gradient(circle_at_bottom_right,_rgba(239,68,68,0.28),_transparent_30%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(120deg,_rgba(255,255,255,0.08)_0%,_rgba(255,255,255,0.02)_100%)]"></div>
    @endif
    <div class="relative z-10 max-w-6xl mx-auto px-6 py-24 text-center">
            <p class="uppercase tracking-widest text-blue-200 text-sm font-semibold mb-4">
                Educación para jóvenes y adultos trabajadores
            </p>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                {{ $contenido['bienvenida'] ?? 'Termina tu bachillerato, a tu ritmo, un fin de semana a la vez' }}
            </h1>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-10">
                Nunca es tarde para cumplir esa meta pendiente. En COGAMA validamos tu experiencia
                de vida y te acompañamos hasta graduarte, sin dejar de trabajar entre semana.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('inscripcion.formulario') }}"
                   class="bg-white text-blue-900 font-bold px-8 py-3.5 rounded-lg hover:bg-blue-50 transition shadow-lg">
                    Quiero inscribirme
                </a>
                <a href="{{ url('/modelo-clei') }}"
                   class="border-2 border-white/70 font-semibold px-8 py-3.5 rounded-lg hover:bg-white/10 transition">
                    ¿Cómo funciona el CLEI?
                </a>
            </div>
        </div>
    </div>
</section>

{{-- POR QUÉ ELEGIRNOS --}}
<section class="max-w-6xl mx-auto px-6 py-20">
    <h2 class="text-3xl font-bold text-center text-slate-800 mb-14">
        ¿Por qué estudiar en COGAMA?
    </h2>
    <div class="grid md:grid-cols-3 gap-10">
        <div class="text-center">
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">
                📅
            </div>
            <h3 class="font-semibold text-lg mb-2">Fines de semana</h3>
            <p class="text-slate-600 text-sm">
                Clases los domingos, pensadas para quien trabaja entre semana.
            </p>
        </div>
        <div class="text-center">
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">
                ⏩
            </div>
            <h3 class="font-semibold text-lg mb-2">Avanza más rápido</h3>
            <p class="text-slate-600 text-sm">
                El sistema CLEI agrupa varios grados en un solo ciclo, así terminas antes.
            </p>
        </div>
        <div class="text-center">
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">
                🎓
            </div>
            <h3 class="font-semibold text-lg mb-2">Título de bachiller</h3>
            <p class="text-slate-600 text-sm">
                El mismo título que respalda cualquier otro bachillerato del país.
            </p>
        </div>
    </div>
</section>

{{-- CÓMO INSCRIBIRSE --}}
<section class="bg-slate-100 py-20">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-slate-800 mb-14">
            Cómo inscribirte en COGAMA
        </h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">📞</div>
                <h3 class="font-semibold text-lg mb-2">1. Solicita información</h3>
                <p class="text-slate-600 text-sm">Escríbenos por WhatsApp o completa el formulario de inscripción para recibir orientación.</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">📄</div>
                <h3 class="font-semibold text-lg mb-2">2. Entrega tus documentos</h3>
                <p class="text-slate-600 text-sm">Prepara la documentación básica y tus certificados de estudios para iniciar el proceso.</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center text-2xl">🎓</div>
                <h3 class="font-semibold text-lg mb-2">3. Inicia tu ciclo</h3>
                <p class="text-slate-600 text-sm">Una vez confirmada tu matrícula, podrás comenzar tu formación los domingos con el apoyo del colegio.</p>
            </div>
        </div>
    </div>
</section>

{{-- NOTICIAS --}}
@if($publicaciones->count())
<section class="bg-slate-100 py-20">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-slate-800 mb-14">
            Noticias y avisos
        </h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($publicaciones as $pub)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                @if($pub->imagen)
                    @if(str_ends_with($pub->imagen, '.pdf'))
                        <a href="{{ asset('storage/' . $pub->imagen) }}" target="_blank"
                           class="flex items-center justify-center h-40 bg-slate-100 text-slate-500 text-sm font-medium hover:bg-slate-200 transition">
                            📄 Ver documento PDF
                        </a>
                    @else
                        <img src="{{ asset('storage/' . $pub->imagen) }}" alt="{{ $pub->titulo ?? 'Publicación' }}" loading="lazy" class="w-full h-40 object-cover">
                    @endif
                @endif
                <div class="p-6">
                    <span class="text-xs uppercase font-semibold text-blue-700">{{ $pub->tipo }}</span>
                    <h3 class="font-bold text-lg mt-2 mb-2">{{ $pub->titulo }}</h3>
                   <p class="text-slate-600 text-sm">{{ $pub->contenido }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA FINAL --}}
<section class="max-w-4xl mx-auto px-6 py-20 text-center">
    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-4">
        Tu bachillerato te está esperando
    </h2>
    <p class="text-slate-600 mb-8">
        Da el primer paso hoy. Cientos de personas como tú ya se graduaron estudiando los fines de semana.
    </p>
    <a href="{{ route('inscripcion.formulario') }}"
       class="inline-block bg-blue-800 hover:bg-blue-900 text-white font-bold px-10 py-4 rounded-lg shadow-md transition">
        Ver requisitos de inscripción
    </a>
</section>

@endsection