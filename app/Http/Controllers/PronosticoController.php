<?php

namespace App\Http\Controllers;

use App\Models\Pronostico;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PronosticoController extends Controller
{
    /**
     * Genera cinco números candidatos mediante análisis estadístico.
     */
    public function generar(): JsonResponse
    {
        // Obtener todos los sorteos en orden cronológico.
        
        $registrosSorteos = DB::table('sorteos')
    ->orderBy('id', 'asc')
    ->get(['id', 'numero']);

$totalSorteos = $registrosSorteos->count();

$ultimoSorteoId = $registrosSorteos->last()->id ?? null;

$sorteos = $registrosSorteos
    ->pluck('numero')
    ->map(fn ($numero) => str_pad((string) $numero, 2, '0', STR_PAD_LEFT))
    ->values();

  

        if ($totalSorteos < 10) {
            return response()->json([
                'mensaje' => 'Se necesitan al menos 10 sorteos para generar un pronóstico.'
            ], 422);
        }

        // Seleccionar los últimos 50 sorteos disponibles.
        $recientes = $sorteos->slice(-50)->values();

        // Inicializar frecuencias para los 100 números.
        $historicas = array_fill(0, 100, 0);
        $recientesFrecuencias = array_fill(0, 100, 0);

        // Frecuencia histórica de cada número.
        foreach ($sorteos as $numero) {
            $historicas[(int) $numero]++;
        }

        // Frecuencia de los últimos 50 sorteos.
        foreach ($recientes as $numero) {
            $recientesFrecuencias[(int) $numero]++;
        }

        // Frecuencia histórica de decenas y unidades.
        $decenas = array_fill(0, 10, 0);
        $unidades = array_fill(0, 10, 0);

        foreach ($sorteos as $numero) {
            $decenas[(int) $numero[0]]++;
            $unidades[(int) $numero[1]]++;
        }

        // Valores máximos para normalizar las puntuaciones.
        $maxHistorica = max($historicas);
        $maxReciente = max($recientesFrecuencias);
        $maxDigitos = max($decenas) + max($unidades);

        $candidatos = [];

        // Analizar los 100 números posibles.
        for ($i = 0; $i <= 99; $i++) {
            $numero = str_pad((string) $i, 2, '0', STR_PAD_LEFT);

            // Puntuación histórica: escala de 0 a 100.
            $pHistorica = $maxHistorica > 0
                ? ($historicas[$i] / $maxHistorica) * 100
                : 0;

            // Puntuación reciente: escala de 0 a 100.
            $pReciente = $maxReciente > 0
                ? ($recientesFrecuencias[$i] / $maxReciente) * 100
                : 0;

            // Puntuación de decenas y unidades.
            $frecuenciaDigitos =
                $decenas[(int) $numero[0]] +
                $unidades[(int) $numero[1]];

            $pDigitos = $maxDigitos > 0
                ? ($frecuenciaDigitos / $maxDigitos) * 100
                : 0;

            // Puntuación final ponderada.
            $pFinal =
                ($pHistorica * 0.50) +
                ($pReciente * 0.30) +
                ($pDigitos * 0.20);

            $candidatos[] = [
                'numero' => $numero,
                'puntuacion' => round($pFinal, 2),
                'puntuacion_historica' => round($pHistorica, 2),
                'puntuacion_reciente' => round($pReciente, 2),
                'puntuacion_digitos' => round($pDigitos, 2),
                'apariciones_historicas' => $historicas[$i],
                'apariciones_recientes' => $recientesFrecuencias[$i],
                'frecuencia_decena' => $decenas[(int) $numero[0]],
                'frecuencia_unidad' => $unidades[(int) $numero[1]],
            ];
        }

        // Ordenar de mayor a menor puntuación.
        usort($candidatos, function ($a, $b) {
            return $b['puntuacion'] <=> $a['puntuacion'];
        });

        // Seleccionar los cinco mejores candidatos.
        $seleccionados = array_slice($candidatos, 0, 5);

        // Guardar pronóstico y candidatos en una transacción.
        $pronostico = DB::transaction(function () use (
    $totalSorteos,
    $recientes,
    $seleccionados,
    $ultimoSorteoId
)  {
           $pronostico = Pronostico::create([
    'total_sorteos_analizados' => $totalSorteos,
    'sorteos_recientes_analizados' => $recientes->count(),
    'fecha_generacion' => now(),
    'ultimo_sorteo_id_analizado' => $ultimoSorteoId,
]);

            foreach ($seleccionados as $indice => $candidato) {
                $pronostico->detalles()->create([
                    'numero' => $candidato['numero'],
                    'puntuacion' => $candidato['puntuacion'],
                    'puntuacion_historica' => $candidato['puntuacion_historica'],
                    'puntuacion_reciente' => $candidato['puntuacion_reciente'],
                    'puntuacion_digitos' => $candidato['puntuacion_digitos'],
                    'posicion' => $indice + 1,
                ]);
            }

            return $pronostico;
        });

        return response()->json([
            'mensaje' => 'Pronóstico generado correctamente.',
            'pronostico_id' => $pronostico->id,
            'total_sorteos_analizados' => $totalSorteos,
            'sorteos_recientes_analizados' => $recientes->count(),
            'candidatos' => $seleccionados,
        ]);
    }


    /**
 * Evalúa los pronósticos pendientes utilizando el primer
 * sorteo registrado después del último sorteo analizado.
 */
public function evaluar(): JsonResponse
{
    $pronosticos = Pronostico::with('detalles')
        ->where('evaluado', false)
        ->orderBy('id')
        ->get();

    $evaluados = 0;

    foreach ($pronosticos as $pronostico) {

    if ($pronostico->ultimo_sorteo_id_analizado === null) {
        continue;
    }

    $sorteo = DB::table('sorteos')
            ->where('id', '>', $pronostico->ultimo_sorteo_id_analizado)
            ->orderBy('id')
            ->first();

        if (!$sorteo) {
            continue;
        }

        DB::transaction(function () use ($pronostico, $sorteo) {

            foreach ($pronostico->detalles as $detalle) {
                $detalle->update([
                    'coincidio' => $detalle->numero ===
                        str_pad((string) $sorteo->numero, 2, '0', STR_PAD_LEFT),
                ]);
            }

            $pronostico->update([
                'sorteo_evaluacion_id' => $sorteo->id,
                'fecha_evaluacion' => now(),
                'evaluado' => true,
            ]);
        });

        $evaluados++;
    }

    return response()->json([
        'mensaje' => 'Proceso de evaluación finalizado.',
        'pronosticos_evaluados' => $evaluados,
    ]);
}

    /**
     * Muestra el historial de pronósticos generados.
     */
    

/**
 * Muestra el historial de pronósticos generados y sus evaluaciones.
 */
public function historial(): JsonResponse
{
    $pronosticos = Pronostico::with('detalles')
        ->orderByDesc('id')
        ->get();

    return response()->json([
        'total_pronosticos' => $pronosticos->count(),

        'pronosticos' => $pronosticos->map(function ($pronostico) {

            $resultadoReal = null;

            if ($pronostico->sorteo_evaluacion_id) {
                $resultadoReal = DB::table('sorteos')
                    ->where('id', $pronostico->sorteo_evaluacion_id)
                    ->value('numero');

                $resultadoReal = str_pad(
                    (string) $resultadoReal,
                    2,
                    '0',
                    STR_PAD_LEFT
                );
            }

            $acierto = $pronostico->detalles->contains(
                fn ($detalle) => $detalle->coincidio
            );

            if (!$pronostico->evaluado) {
                $estado = 'Pendiente';
            } elseif ($acierto) {
                $estado = 'Con acierto';
            } else {
                $estado = 'Sin acierto';
            }

            return [
                'id' => $pronostico->id,
                'fecha_generacion' => $pronostico->fecha_generacion,
                'total_sorteos_analizados' => $pronostico->total_sorteos_analizados,
                'evaluado' => $pronostico->evaluado,
                'resultado_real' => $resultadoReal,
                'estado' => $estado,

                'candidatos' => $pronostico->detalles
                    ->sortBy('posicion')
                    ->map(function ($detalle) {
                        return [
                            'numero' => $detalle->numero,
                            'posicion' => $detalle->posicion,
                            'coincidio' => $detalle->coincidio,
                        ];
                    })->values(),
            ];
        })->values(),
    ]);
}


/**
 * Presenta los indicadores generales del panel de pronósticos.
 */
public function panel()
{
    $pronosticos = Pronostico::with('detalles')->get();

    $totalPronosticos = $pronosticos->count();

    $evaluados = $pronosticos->where('evaluado', true);

    $totalEvaluados = $evaluados->count();

    $pendientes = $totalPronosticos - $totalEvaluados;

    // Pronósticos que tuvieron al menos un acierto.
    $conAcierto = $evaluados->filter(function ($pronostico) {
        return $pronostico->detalles->contains(
            fn ($detalle) => $detalle->coincidio
        );
    })->count();

    // Porcentaje de efectividad sobre los pronósticos evaluados.
    $efectividad = $totalEvaluados > 0
        ? round(($conAcierto / $totalEvaluados) * 100, 2)
        : 0;

    // Aciertos individuales según la posición del candidato.
    $aciertosPorPosicion = [];

    for ($posicion = 1; $posicion <= 5; $posicion++) {
        $aciertosPorPosicion[$posicion] = $evaluados
            ->flatMap(fn ($pronostico) => $pronostico->detalles)
            ->where('posicion', $posicion)
            ->where('coincidio', true)
            ->count();
    }

    return view('panel_pronosticos', compact(
        'totalPronosticos',
        'totalEvaluados',
        'pendientes',
        'conAcierto',
        'efectividad',
        'aciertosPorPosicion'
    ));
}


}
