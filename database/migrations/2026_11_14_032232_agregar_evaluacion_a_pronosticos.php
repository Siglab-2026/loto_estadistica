<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pronosticos', function (Blueprint $table) {
            $table->unsignedBigInteger('ultimo_sorteo_id_analizado')
                ->nullable();

            $table->foreignId('sorteo_evaluacion_id')
                ->nullable()
                ->constrained('sorteos')
                ->nullOnDelete();

            $table->timestamp('fecha_evaluacion')->nullable();

            $table->boolean('evaluado')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('pronosticos', function (Blueprint $table) {
            $table->dropForeign(['sorteo_evaluacion_id']);
            $table->dropColumn([
                'ultimo_sorteo_id_analizado',
                'sorteo_evaluacion_id',
                'fecha_evaluacion',
                'evaluado',
            ]);
        });
    }
};