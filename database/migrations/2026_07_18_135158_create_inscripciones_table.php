<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('inscripciones', function (Blueprint $table) {
        $table->id();
        $table->string('nombres');
        $table->string('apellidos');
        $table->string('documento');
        $table->string('telefono');
        $table->string('email')->nullable();
        $table->foreignId('ciclo_interes_id')->nullable()->constrained('ciclos')->nullOnDelete();
        $table->text('mensaje')->nullable();
        $table->enum('estado', ['pendiente', 'contactado'])->default('pendiente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
