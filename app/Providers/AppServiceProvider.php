<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   /**
    * Register any application services.
    */
   public function register(): void
   {
       //
   }

   /**
    * Bootstrap any application services.
    */
   public function boot(): void
   {
       view()->composer('layouts.public', function ($view) {
           $contenido = \App\Models\ContenidoInstitucional::pluck('valor', 'clave')->toArray();

           foreach (['escudo_imagen', 'bandera_imagen', 'imagen_portada'] as $clave) {
               if (!empty($contenido[$clave])) {
                   $valor = $contenido[$clave];

                   if (Str::startsWith($valor, ['http://', 'https://'])) {
                       $contenido[$clave] = $valor;
                   } else {
                       $ruta = ltrim($valor, '/');

                       if (Storage::disk('public')->exists($ruta)) {
                           $contenido[$clave] = Storage::url($ruta);
                       } elseif (Storage::disk('public')->exists('institucional/' . basename($ruta))) {
                           $contenido[$clave] = Storage::url('institucional/' . basename($ruta));
                       } else {
                           $contenido[$clave] = asset('storage/' . $ruta);
                       }
                   }
               }
           }

           $view->with('contenidoFooter', $contenido);
       });
   }
}
