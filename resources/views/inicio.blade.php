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

{{-- CARRUSEL DE PUBLICACIONES --}}
@php
    // Si hay diapositivas desde el admin (carrusel), usarlas; si no, usar publicaciones como fallback
    $carouselItems = collect();
    if (!empty($carruselSlides) && $carruselSlides->count()) {
        $carouselItems = $carruselSlides->map(function($s){
            return [
                'src' => asset('storage/' . $s->imagen),
                'alt' => $s->titulo ?? 'Diapositiva',
                'titulo' => $s->titulo ?? '',
                'descripcion' => $s->subtitulo ?? '',
            ];
        })->values();
    } else {
        $carouselItems = $publicaciones->filter(fn($p) => $p->imagen && !str_ends_with($p->imagen, '.pdf'))->map(function($p){
            return [
                'src' => asset('storage/' . $p->imagen),
                'alt' => $p->titulo ?? 'Publicación',
                'titulo' => $p->titulo ?? '',
                'descripcion' => Str::limit($p->contenido ?? '', 140),
            ];
        })->values();
    }
@endphp

@if($carouselItems->count())
<section class="max-w-6xl mx-auto px-6 py-8">
    <div x-data='{ 
            items: {!! $carouselItems->toJson(JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!},
            index: 0,
            timer: null,
            touchStart: null,
            init() {
                if(this.items && this.items.length > 1) {
                    this.start();
                }
            },
            start() { this.stop(); this.timer = setInterval(() => { this.next(); }, 4000); },
            stop() { if(this.timer) { clearInterval(this.timer); this.timer = null; } },
            prev() { this.index = (this.index - 1 + this.items.length) % this.items.length; },
            next() { this.index = (this.index + 1) % this.items.length; },
            onTouchStart(e) { this.touchStart = e.touches[0].clientX; },
            onTouchEnd(e) { const dx = (this.touchStart || 0) - e.changedTouches[0].clientX; if (dx > 50) { this.next(); } else if (dx < -50) { this.prev(); } this.touchStart = null; }
        }' x-init="init()" @mouseenter="stop()" @mouseleave="start()" @touchstart.window="onTouchStart($event)" @touchend.window="onTouchEnd($event)" class="relative">

        <template x-for="(item, i) in items" :key="i">
            <div x-show="index === i" x-transition class="rounded-xl overflow-hidden shadow-sm">
                <img :src="item.src" :alt="item.alt" class="w-full h-64 md:h-80 object-contain">
                <div class="p-4 bg-white">
                    <h3 class="font-semibold text-slate-800" x-text="item.titulo"></h3>
                    <p class="text-sm text-slate-600 mt-1" x-text="item.descripcion"></p>
                </div>
            </div>
        </template>

        <!-- Controls -->
        <button type="button" @click="prev()" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 text-slate-800 rounded-full p-2 shadow hover:bg-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 16.293a1 1 0 010-1.414L15.586 11H5a1 1 0 110-2h10.586l-3.293-3.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
        </button>
        <button type="button" @click="next()" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 text-slate-800 rounded-full p-2 shadow hover:bg-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 16.293a1 1 0 010-1.414L15.586 11H5a1 1 0 110-2h10.586l-3.293-3.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
        </button>

        <!-- Indicators -->
        <div class="flex justify-center gap-2 mt-4">
            <template x-for="(item, i) in items" :key="i">
                <button @click="index = i" :class="{'bg-blue-800': index===i, 'bg-slate-300': index!==i }" class="w-3 h-3 rounded-full"></button>
            </template>
        </div>

    </div>
</section>
@endif

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
                        <img src="{{ asset('storage/' . $pub->imagen) }}" alt="{{ $pub->titulo ?? 'Publicación' }}" loading="lazy" class="w-full h-40 object-contain bg-white">
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

{{-- CARRUSEL INSTITUCIONAL --}}
@if(!empty($contenido['carrusel_oficina_imagen']) || !empty($contenido['carrusel_sede_imagen']) || !empty($contenido['escudo_imagen']))
<section class="py-16 bg-slate-100">
    <div class="max-w-5xl mx-auto px-6">

        <div class="relative rounded-2xl overflow-hidden shadow-lg" x-data="{ slide: 0, total: 3, timer: null }"
             x-init="timer = setInterval(() => slide = (slide + 1) % total, 6000)"
             @touchstart="touchX = $event.touches[0].clientX"
             @touchend="if (touchX - $event.changedTouches[0].clientX > 50) { slide = (slide + 1) % total; clearInterval(timer); timer = setInterval(() => slide = (slide + 1) % total, 6000); } else if ($event.changedTouches[0].clientX - touchX > 50) { slide = (slide - 1 + total) % total; clearInterval(timer); timer = setInterval(() => slide = (slide + 1) % total, 6000); }">

            <div class="relative h-80 md:h-96">

                {{-- SLIDE 1: OFICINA --}}
                <div x-show="slide === 0" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                    @if(!empty($contenido['carrusel_oficina_imagen']))
                        <img src="{{ asset('storage/' . $contenido['carrusel_oficina_imagen']) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-blue-900"></div>
                    @endif
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div class="absolute bottom-6 left-6 bg-white rounded-xl shadow-lg px-6 py-4 max-w-xs">
                        <p class="text-xs uppercase tracking-wide text-slate-500 font-semibold mb-1">Horario de atención</p>
                        <p class="text-blue-900 font-bold whitespace-pre-line">{{ $contenido['horario_secretaria'] ?? 'Consulta nuestro horario' }}</p>
                    </div>
                </div>

                {{-- SLIDE 2: SEDE --}}
                <div x-show="slide === 1" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                    @if(!empty($contenido['carrusel_sede_imagen']))
                        <img src="{{ asset('storage/' . $contenido['carrusel_sede_imagen']) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-blue-800"></div>
                    @endif
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div class="absolute bottom-6 left-6 bg-white rounded-xl shadow-lg px-6 py-4 max-w-xs">
                        <p class="text-xs uppercase tracking-wide text-slate-500 font-semibold mb-1">Horario de clases</p>
                        <p class="text-blue-900 font-bold">Domingos: {{ $contenido['horario_clases'] ?? '7:00 a.m. - 1:05 p.m.' }}</p>
                    </div>
                </div>

                {{-- SLIDE 3: ESCUDO --}}
                <div x-show="slide === 2" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 bg-blue-950 flex items-center px-10">
                    @if(!empty($contenido['escudo_imagen']))
                       <img src="{{ $contenido['escudo_imagen'] }}" class="h-32 md:h-40 mr-8">
                    @endif
                    <div class="text-white max-w-md">
                        <h3 class="text-2xl font-bold mb-2">{{ $contenido['bienvenida'] ?? 'Estudiar es progresar' }}</h3>
                        <p class="text-blue-200 text-sm">Nunca es tarde para cumplir esa meta pendiente.</p>
                    </div>
                </div>

            </div>

            {{-- FLECHAS (escritorio) --}}
            <button @click="slide = (slide - 1 + total) % total; clearInterval(timer); timer = setInterval(() => slide = (slide + 1) % total, 6000)"
                    class="hidden md:flex absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white w-10 h-10 rounded-full items-center justify-center shadow transition">
                ‹
            </button>
            <button @click="slide = (slide + 1) % total; clearInterval(timer); timer = setInterval(() => slide = (slide + 1) % total, 6000)"
                    class="hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white w-10 h-10 rounded-full items-center justify-center shadow transition">
                ›
            </button>

            {{-- PUNTOS --}}
            <div class="absolute bottom-4 right-6 flex gap-2">
                <button @click="slide = 0" :class="slide === 0 ? 'bg-white' : 'bg-white/40'" class="w-2.5 h-2.5 rounded-full transition"></button>
                <button @click="slide = 1" :class="slide === 1 ? 'bg-white' : 'bg-white/40'" class="w-2.5 h-2.5 rounded-full transition"></button>
                <button @click="slide = 2" :class="slide === 2 ? 'bg-white' : 'bg-white/40'" class="w-2.5 h-2.5 rounded-full transition"></button>
            </div>

       </div>
    </div>
</section>
@endif

@endsection