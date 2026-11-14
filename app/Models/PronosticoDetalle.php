<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PronosticoDetalle extends Model
{
    protected $fillable = [
        'pronostico_id',
        'numero',
        'puntuacion',
        'puntuacion_historica',
        'puntuacion_reciente',
        'puntuacion_digitos',
        'posicion',
        'coincidio',
    ];

    protected $casts = [
        'puntuacion' => 'decimal:2',
        'puntuacion_historica' => 'decimal:2',
        'puntuacion_reciente' => 'decimal:2',
        'puntuacion_digitos' => 'decimal:2',
        'coincidio' => 'boolean',
    ];

    public function pronostico(): BelongsTo
    {
        return $this->belongsTo(Pronostico::class);
    }
}
