<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pronostico extends Model
{
    protected $fillable = [
    'total_sorteos_analizados',
    'sorteos_recientes_analizados',
    'fecha_generacion',
    'ultimo_sorteo_id_analizado',
    'sorteo_evaluacion_id',
    'fecha_evaluacion',
    'evaluado',
];

  protected $casts = [
    'fecha_generacion' => 'datetime',
    'fecha_evaluacion' => 'datetime',
    'evaluado' => 'boolean',
];
    public function detalles(): HasMany
    {
        return $this->hasMany(PronosticoDetalle::class);
    }
}
