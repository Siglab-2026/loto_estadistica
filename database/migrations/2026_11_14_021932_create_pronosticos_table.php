
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pronosticos', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('total_sorteos_analizados');
            $table->unsignedInteger('sorteos_recientes_analizados');

            $table->timestamp('fecha_generacion');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pronosticos');
    }
};
