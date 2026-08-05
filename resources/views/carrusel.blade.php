@extends('layouts.public')

@section('title', 'Carrusel | COGAMA')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-6">Carrusel institucional</h1>

    {{-- Main carousel (todas las diapositivas activas) --}}
    @php
        $all = collect($slides)->flatten(1)->values();
    @endphp

    <div class="mb-10">
        <div x-data='{ idx: 0, slides: @json($all), timer: null, interval: 4500, touchStart: null, pause(){ clearInterval(this.timer) }, play(){ if(!this.slides || !this.slides.length) return; this.timer = setInterval(()=>{ this.idx = (this.idx+1) % this.slides.length }, this.interval) }, prev(){ this.idx = (this.idx - 1 + this.slides.length) % this.slides.length }, next(){ this.idx = (this.idx + 1) % this.slides.length }, onTouchStart(e){ this.touchStart = e.touches[0].clientX }, onTouchEnd(e){ const dx = (this.touchStart||0) - e.changedTouches[0].clientX; if(dx>50){ this.next() } else if(dx<-50){ this.prev() } this.touchStart = null } }' x-init="play()" @mouseenter="pause()" @mouseleave="play()" @touchstart="onTouchStart($event)" @touchend="onTouchEnd($event)">
            <template x-if="slides.length === 0">
                <div class="bg-slate-50 p-12 text-center text-slate-500 rounded">No hay diapositivas para mostrar.</div>
            </template>

            <div class="overflow-hidden rounded-lg shadow">
                <template x-for="(s, i) in slides" :key="i">
                    <div x-show="idx === i" x-transition class="w-full">
                        <img :src="`/storage/${s.imagen}`" class="w-full h-96 object-cover" :alt="s.titulo ?? 'Diapositiva'">
                        <div class="p-6 bg-white">
                            <h3 class="font-semibold text-xl" x-text="s.titulo"></h3>
                            <p class="text-sm text-slate-600 mt-1" x-text="s.subtitulo"></p>
                        </div>
                    </div>
                </template>
            </div>

            <div class="flex justify-center mt-3 space-x-2">
                <template x-for="(s,i) in slides" :key="i">
                    <button @click="idx = i" :class="{'bg-blue-800': idx===i, 'bg-slate-300': idx!==i }" class="w-3 h-3 rounded-full"></button>
                </template>
            </div>
        </div>
    </div>

    {{-- Oficina: mostrar primera diapositiva tipo oficina con horario/dirección --}}
    @php $oficina = (isset($slides['oficina']) && count($slides['oficina']) ) ? collect($slides['oficina'])->first() : null; @endphp
    @if($oficina)
    <div class="grid md:grid-cols-2 gap-6 items-center mb-8">
        <div>
            <img src="{{ asset('storage/' . $oficina['imagen']) }}" class="w-full h-64 object-cover rounded-lg shadow">
        </div>
        <div>
            <h3 class="text-xl font-semibold">{{ $oficina['titulo'] ?? 'Oficina' }}</h3>
            <p class="text-slate-600 mt-2">{{ $oficina['subtitulo'] ?? '' }}</p>
            @if(!empty($oficina['horario']))
                <div class="mt-3"><strong>Horario de atención:</strong> {{ $oficina['horario'] }}</div>
            @endif
            @if(!empty($oficina['direccion']))
                <div class="mt-1"><strong>Dirección:</strong> {{ $oficina['direccion'] }}</div>
            @endif
        </div>
    </div>
    @endif

    {{-- Sede académica: mostrar primera diapositiva tipo sede con horario/dirección --}}
    @php $sede = (isset($slides['sede']) && count($slides['sede']) ) ? collect($slides['sede'])->first() : null; @endphp
    @if($sede)
    <div class="grid md:grid-cols-2 gap-6 items-center mb-8">
        <div class="md:order-2">
            <img src="{{ asset('storage/' . $sede['imagen']) }}" class="w-full h-64 object-cover rounded-lg shadow">
        </div>
        <div class="md:order-1">
            <h3 class="text-xl font-semibold">{{ $sede['titulo'] ?? 'Sede académica' }}</h3>
            <p class="text-slate-600 mt-2">{{ $sede['subtitulo'] ?? '' }}</p>
            @if(!empty($sede['horario']))
                <div class="mt-3"><strong>Horario de clases:</strong> {{ $sede['horario'] }}</div>
            @endif
            @if(!empty($sede['direccion']))
                <div class="mt-1"><strong>Dirección:</strong> {{ $sede['direccion'] }}</div>
            @endif
        </div>
    </div>
    @endif

    {{-- Información adicional: contacto rápido --}}
    <div class="bg-slate-50 p-6 rounded-lg">
        <h4 class="font-semibold">Contacto y ubicación</h4>
        <p class="text-sm text-slate-600 mt-2">Si necesitas actualizar direcciones u horarios, usa el panel administrativo > Carrusel y marca la diapositiva correspondiente como "Oficina" o "Sede académica".</p>
        <div class="mt-4">
            <a href="{{ route('contacto') }}" class="inline-block bg-blue-800 text-white px-4 py-2 rounded">Ver contacto</a>
        </div>
    </div>

</div>
@endsection
