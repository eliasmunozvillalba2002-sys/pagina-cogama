<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') | COGAMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-blue-950 text-blue-100 flex flex-col">
        <div class="px-6 py-5 border-b border-blue-900">
            <span class="text-white font-bold text-lg">COGAMA</span>
            <p class="text-xs text-blue-300">Panel administrativo</p>
        </div>

        <nav class="flex-grow px-3 py-4 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-3 py-2.5 rounded-lg hover:bg-blue-900 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-900 text-white' : '' }}">
                Inicio
            </a>
            <a href="#" class="block px-3 py-2.5 rounded-lg hover:bg-blue-900 transition">Notas</a>
           <a href="{{ route('admin.docentes.index') }}"
               class="block px-3 py-2.5 rounded-lg hover:bg-blue-900 transition {{ request()->routeIs('admin.docentes.*') ? 'bg-blue-900 text-white' : '' }}">
                Docentes
            </a>
            <a href="{{ route('admin.publicaciones.index') }}"
               class="block px-3 py-2.5 rounded-lg hover:bg-blue-900 transition {{ request()->routeIs('admin.publicaciones.*') ? 'bg-blue-900 text-white' : '' }}">
                Publicaciones
            </a>
            <a href="{{ route('admin.inscripciones.index') }}"
               class="block px-3 py-2.5 rounded-lg hover:bg-blue-900 transition {{ request()->routeIs('admin.inscripciones.*') ? 'bg-blue-900 text-white' : '' }}">
                Inscripciones
            </a>
            <a href="{{ route('admin.galeria.index') }}"
               class="block px-3 py-2.5 rounded-lg hover:bg-blue-900 transition {{ request()->routeIs('admin.galeria.*') ? 'bg-blue-900 text-white' : '' }}">
                Galería
            </a>
            <a href="{{ route('admin.contenido.edit') }}"
               class="block px-3 py-2.5 rounded-lg hover:bg-blue-900 transition {{ request()->routeIs('admin.contenido.*') ? 'bg-blue-900 text-white' : '' }}">
                Contenido del colegio
            </a>
        </nav>

        <div class="px-3 py-4 border-t border-blue-900">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2.5 rounded-lg hover:bg-blue-900 text-sm transition">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- CONTENIDO --}}
    <div class="flex-grow flex flex-col">
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold text-slate-800">@yield('title', 'Panel administrativo')</h1>
            <span class="text-sm text-slate-500">{{ Auth::user()->name }}</span>
        </header>
        <main class="flex-grow p-8">
            @yield('content')
        </main>
    </div>

</div>
</body>
</html>