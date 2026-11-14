
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pronostico_detalles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pronostico_id')
                ->constrained('pronosticos')
                ->cascadeOnDelete();

            $table->char('numero', 2);

            $table->decimal('puntuacion', 6, 2);
            $table->decimal('puntuacion_historica', 6, 2);
            $table->decimal('puntuacion_reciente', 6, 2);
            $table->decimal('puntuacion_digitos', 6, 2);

            $table->unsignedTinyInteger('posicion');

            $table->boolean('coincidio')->default(false);

            $table->timestamps();

            $table->unique(['pronostico_id', 'numero']);
            $table->unique(['pronostico_id', 'posicion']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pronostico_detalles');
    }
};
