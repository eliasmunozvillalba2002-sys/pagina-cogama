<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('inscripciones', function (Blueprint $table) {
        $table->timestamp('fecha_matricula')->nullable()->after('estado');
    });

    DB::statement("ALTER TABLE inscripciones MODIFY estado ENUM('pendiente', 'contactado', 'matriculado') DEFAULT 'pendiente'");
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripciones', function (Blueprint $table) {
            //
        });
    }
};
