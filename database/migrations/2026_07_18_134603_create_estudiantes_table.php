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
    Schema::create('estudiantes', function (Blueprint $table) {
        $table->id();
        $table->string('documento')->unique();
        $table->string('nombres');
        $table->string('apellidos');
        $table->foreignId('ciclo_id')->nullable()->constrained('ciclos')->nullOnDelete();
        $table->string('telefono')->nullable();
        $table->string('email')->nullable();
        $table->enum('estado', ['activo', 'retirado', 'graduado'])->default('activo');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
