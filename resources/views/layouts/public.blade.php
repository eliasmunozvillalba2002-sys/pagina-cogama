<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COGAMA') | Colegio Gabriel García Márquez</title>
    <meta name="description" content="@yield('meta_description', $contenidoFooter['descripcion_corta'] ?? 'Colegio Gabriel García Márquez - Educación para jóvenes y adultos trabajadores. Inscripciones y noticias.')">
    <!-- Open Graph -->
    <meta property="og:site_name" content="{{ $contenidoFooter['nombre_colegio'] ?? 'COGAMA' }}">
    <meta property="og:title" content="@yield('title', 'COGAMA')">
    <meta property="og:description" content="@yield('meta_description', $contenidoFooter['descripcion_corta'] ?? 'Colegio Gabriel García Márquez - Educación para jóvenes y adultos trabajadores.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(!empty($contenidoFooter['logo']))
        <meta property="og:image" content="{{ asset('storage/' . $contenidoFooter['logo']) }}">
    @endif
    @if(!empty(env('GOOGLE_ANALYTICS_ID')))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ID') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);} 
            gtag('js', new Date());
            gtag('config', '{{ env('GOOGLE_ANALYTICS_ID') }}');
        </script>
    @endif
    @php
        $schemaOrg = [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => $contenidoFooter['nombre_colegio'] ?? 'Colegio Gabriel García Márquez',
            'url' => url('/'),
            'description' => $contenidoFooter['descripcion_corta'] ?? 'Colegio Gabriel García Márquez - Educación para jóvenes y adultos trabajadores.',
        ];

        if (!empty($contenidoFooter['direccion'])) {
            $schemaOrg['address'] = [
                '@type' => 'PostalAddress',
                'streetAddress' => $contenidoFooter['direccion'],
            ];
        }

        if (!empty($contenidoFooter['telefono'])) {
            $schemaOrg['telephone'] = $contenidoFooter['telefono'];
        }

        if (!empty($contenidoFooter['correo_contacto'])) {
            $schemaOrg['email'] = $contenidoFooter['correo_contacto'];
        }
    @endphp
    <script type="application/ld+json">
        {{ json_encode($schemaOrg, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen relative">

    {{-- NAVBAR --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm" x-data="{ open: false }">
        <nav class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3 text-xl font-bold text-blue-800 tracking-tight">
                @if(!empty($contenidoFooter['escudo_imagen']))
                    <img src="{{ $contenidoFooter['escudo_imagen'] }}" alt="Escudo del colegio" class="h-9 w-9 object-contain rounded-md bg-white p-0.5 shadow-none">
                @endif
                <span>{{ $contenidoFooter['nombre_colegio'] ?? 'COGAMA' }}</span>
            </a>

            <!-- Mobile hamburger -->
            <button @click="open = !open" class="md:hidden text-slate-600" :aria-expanded="open.toString()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <li><a href="{{ url('/') }}" class="hover:text-blue-700 transition">Inicio</a></li>
                <li><a href="{{ route('quienes-somos') }}" class="hover:text-blue-700 transition">Quiénes somos</a></li>
                <li><a href="{{ route('docentes.publico') }}" class="hover:text-blue-700 transition">Nuestro Equipo</a></li>
                <li><a href="{{ url('/modelo-clei') }}" class="hover:text-blue-700 transition">Modelo CLEI</a></li>
                <li><a href="{{ route('galeria') }}" class="hover:text-blue-700 transition">Galería</a></li>
                <li><a href="{{ url('/contacto') }}" class="hover:text-blue-700 transition">Contacto</a></li>
            </ul>

            <div class="hidden md:block">
                <a href="{{ route('login') }}" class="text-xs text-slate-400 hover:text-slate-600 transition">
                    Acceder
                </a>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div class="md:hidden" x-show="open" x-transition>
            <div class="px-6 pb-4">
                <ul class="space-y-3">
                    <li><a href="{{ url('/') }}" class="block text-slate-700">Inicio</a></li>
                    <li><a href="{{ route('quienes-somos') }}" class="block text-slate-700">Quiénes somos</a></li>
                    <li><a href="{{ route('docentes.publico') }}" class="block text-slate-700">Nuestro Equipo</a></li>
                    <li><a href="{{ url('/modelo-clei') }}" class="block text-slate-700">Modelo CLEI</a></li>
                    <li><a href="{{ route('galeria') }}" class="block text-slate-700">Galería</a></li>
                    <li><a href="{{ url('/contacto') }}" class="block text-slate-700">Contacto</a></li>
                    <li><a href="{{ route('login') }}" class="block text-slate-700">Acceder</a></li>
                </ul>
            </div>
        </div>
    </header>

    {{-- CONTENIDO --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    @if(!empty($contenidoFooter['whatsapp']))
        <a href="https://wa.me/57{{ preg_replace('/\D/', '', $contenidoFooter['whatsapp']) }}"
           target="_blank"
           rel="noopener noreferrer"
           class="fixed bottom-5 right-5 z-50 inline-flex items-center gap-2 rounded-full bg-green-600 px-4 py-3 text-sm font-semibold text-white shadow-lg hover:bg-green-700 transition">
            <span class="text-lg">💬</span>
            Escribir por WhatsApp
        </a>
    @endif

    {{-- FOOTER --}}
    <footer class="bg-blue-950 text-slate-300 mt-16">
        <div class="max-w-6xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8 text-sm">
            <div>
                <h3 class="text-white font-semibold mb-3">{{ $contenidoFooter['nombre_colegio'] ?? 'Colegio Gabriel García Márquez' }}</h3>
                <p>Educación para jóvenes y adultos trabajadores. Modalidaddominical — Programa CLEI.</p>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3">Enlaces</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/modelo-clei') }}" class="hover:text-white transition">Modelo CLEI</a></li>
                    <li><a href="{{ url('/contacto') }}" class="hover:text-white transition">Requisitos de matrícula</a></li>
                    <li><a href="{{ route('galeria') }}" class="hover:text-white transition">Galería</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3">Contacto</h3>
                <p>{{ $contenidoFooter['direccion'] ?? 'Ayapel, Córdoba' }}</p>
                @if(!empty($contenidoFooter['whatsapp']))
                    <p>WhatsApp: {{ $contenidoFooter['whatsapp'] }}</p>
                @endif
                @if(!empty($contenidoFooter['correo_contacto']))
                    <p>{{ $contenidoFooter['correo_contacto'] }}</p>
                @endif
                @if(!empty($contenidoFooter['horario_secretaria']))
                    <p>Horario: {{ $contenidoFooter['horario_secretaria'] }}</p>
                @endif
            </div>
        </div>
        <div class="border-t border-blue-900 text-center text-xs py-4 text-slate-400">
            &copy; {{ date('Y') }} Colegio Gabriel García Márquez (COGAMA). Todos los derechos reservados.
        </div>
    </footer>

</body>
</html>