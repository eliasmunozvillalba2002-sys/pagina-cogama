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
    Schema::create('notas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('estudiante_id')->constrained('estudiantes')->cascadeOnDelete();
        $table->foreignId('ciclo_id')->constrained('ciclos')->cascadeOnDelete();
        $table->foreignId('asignatura_id')->constrained('asignaturas')->cascadeOnDelete();
        $table->unsignedTinyInteger('periodo');
        $table->decimal('nota', 3, 1);
        $table->text('observaciones')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
