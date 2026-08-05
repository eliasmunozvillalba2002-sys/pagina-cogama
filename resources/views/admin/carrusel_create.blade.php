@extends('layouts.admin')

@section('title', 'Nueva diapositiva')

@section('content')

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    @if ($errors->any())
        <div class="mb-4 bg-red-50 text-red-700 p-3 rounded">
            <strong>Hay errores en el formulario:</strong>
            <ul class="mt-2 ml-4 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.carrusel.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm text-slate-700">Imagen (recomendado 1600x900)</label>
                <input type="file" name="imagen" accept="image/*" required class="mt-2 block w-full" />
                @error('imagen') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-700">Tipo</label>
                <select name="tipo" class="mt-2 block w-full">
                                    <option value="general" {{ old('tipo') == 'general' ? 'selected' : '' }}>General</option>
                                    <option value="oficina" {{ old('tipo') == 'oficina' ? 'selected' : '' }}>Oficina</option>
                                    <option value="sede" {{ old('tipo') == 'sede' ? 'selected' : '' }}>Sede académica</option>
                </select>
            </div>

            <div>
                <label class="block text-sm text-slate-700">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}" class="mt-2 block w-full" />
            </div>

            <div>
                <label class="block text-sm text-slate-700">Subtítulo</label>
                <input type="text" name="subtitulo" value="{{ old('subtitulo') }}" class="mt-2 block w-full" />
            </div>

            <div class="col-span-2">
                <label class="block text-sm text-slate-700">Horario (opcional)</label>
                <input type="text" name="horario" value="{{ old('horario') }}" class="mt-2 block w-full" placeholder="Ej: Lunes y Miércoles 9:00 - 11:00" />
            </div>

            <div class="col-span-2">
                <label class="block text-sm text-slate-700">Dirección (opcional)</label>
                <input type="text" name="direccion" value="{{ old('direccion') }}" class="mt-2 block w-full" placeholder="Calle 123, Barrio" />
            </div>

            <div>
                <label class="block text-sm text-slate-700">Orden</label>
                <input type="number" name="orden" value="{{ old('orden', 0) }}" class="mt-2 block w-full" />
            </div>

            <div class="flex items-center">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="activo" value="1" checked class="form-checkbox" />
                    <span class="ml-2 text-sm text-slate-700">Activo</span>
                </label>
            </div>
        </div>

        <div class="mt-6">
            <button class="bg-blue-800 hover:bg-blue-900 text-white px-5 py-2.5 rounded">Guardar</button>
        </div>
    </form>
</div>

@endsection
