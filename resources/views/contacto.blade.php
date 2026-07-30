@extends('layouts.public')

@section('title', 'Contacto')
@section('meta_description', 'Contacta al Colegio Gabriel García Márquez para recibir información de matrícula, horarios de secretaría, WhatsApp y ubicación en Ayapel, Córdoba.')

@section('content')

<section class="bg-blue-950 text-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <p class="uppercase tracking-widest text-blue-300 text-sm font-semibold mb-3">Contacto</p>
        <h1 class="text-2xl md:text-3xl font-bold">Estamos para ayudarte</h1>
    </div>
</section>

<section class="max-w-4xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12">

    <div>
        <h2 class="text-xl font-bold text-slate-800 mb-6">Información de contacto</h2>
        <div class="space-y-4 text-slate-600">
            @if(!empty($contenido['direccion']))
            <p><span class="font-semibold text-slate-800">Dirección:</span><br>{{ $contenido['direccion'] }}</p>
            @endif
            @if(!empty($contenido['telefono']))
            <p><span class="font-semibold text-slate-800">Teléfono:</span><br>{{ $contenido['telefono'] }}</p>
            @endif
            @if(!empty($contenido['whatsapp']))
            <p><span class="font-semibold text-slate-800">WhatsApp:</span><br>
                <a href="https://wa.me/57{{ preg_replace('/\D/', '', $contenido['whatsapp']) }}" target="_blank" class="text-blue-700 hover:underline">
                    {{ $contenido['whatsapp'] }}
                </a>
            </p>
            @endif
            @if(!empty($contenido['correo_contacto']))
            <p><span class="font-semibold text-slate-800">Correo:</span><br>{{ $contenido['correo_contacto'] }}</p>
            @endif
            @if(!empty($contenido['horario_secretaria']))
           <p><span class="font-semibold text-slate-800">Horario de secretaría:</span><br>{!! nl2br(e($contenido['horario_secretaria'])) !!}</p>
            @endif
        </div>
    </div>

    <div>
        <h2 class="text-xl font-bold text-slate-800 mb-6">Requisitos de matrícula</h2>
        <ul class="space-y-2 text-slate-600 text-sm list-disc list-inside">
            <li>Fotocopia del documento de identidad del estudiante (cédula o tarjeta de identidad)</li>
            <li>Fotocopia de la cédula del acudiente</li>
            <li>Certificados de los estudios ya cursados, desde 5° de primaria en adelante</li>
            <li>Recibo de servicio de luz (para confirmar la dirección de residencia)</li>
        </ul>
        <a href="{{ route('inscripcion.formulario') }}"
           class="inline-block mt-6 bg-blue-800 hover:bg-blue-900 text-white font-bold px-8 py-3.5 rounded-lg shadow-md transition">
            Iniciar inscripción
        </a>
    </div>

</section>

@if(!empty($contenido['direccion']))
<section class="max-w-4xl mx-auto px-6 pb-16">
    <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
        <iframe
            src="https://www.google.com/maps?q={{ urlencode($contenido['direccion']) }}&output=embed"
            loading="lazy"
            class="w-full h-72 border-0"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
</section>
@endif

@endsection