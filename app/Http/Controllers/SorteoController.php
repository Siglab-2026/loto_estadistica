<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SorteoController extends Controller
{
    /**
     * Genera y almacena un número aleatorio de dos cifras.
     */
    public function generar(): JsonResponse
    {
        $primeraCifra = random_int(0, 9);
        $segundaCifra = random_int(0, 9);

        // Se almacena como texto para conservar los ceros iniciales.
        $numero = (string) $primeraCifra . (string) $segundaCifra;

        $sorteo = \App\Models\Sorteo::create([
            'numero' => $numero,
        ]);

        return response()->json([
            'id' => $sorteo->id,
            'numero' => str_pad((string) $sorteo->numero, 2, '0', STR_PAD_LEFT),
            'created_at' => $sorteo->created_at,
        ]);
    }

    /**
     * Devuelve las frecuencias absolutas de los 100 números posibles.
     */
    public function frecuencias(): JsonResponse
    {
        $frecuencias = DB::table('sorteos')
            ->selectRaw("
                LPAD(numero, 2, '0') AS numero,
                COUNT(*) AS frecuencia_absoluta
            ")
            ->groupBy('numero')
            ->get()
            ->keyBy('numero');

        $resultado = [];

        for ($i = 0; $i <= 99; $i++) {
            $numero = str_pad((string) $i, 2, '0', STR_PAD_LEFT);

            $resultado[] = [
                'numero' => $numero,
                'frecuencia_absoluta' => isset($frecuencias[$numero])
                    ? (int) $frecuencias[$numero]->frecuencia_absoluta
                    : 0,
            ];
        }

        return response()->json([
            'total_sorteos' => DB::table('sorteos')->count(),
            'frecuencias' => $resultado,
        ]);
    }

    /**
     * Calcula las medidas descriptivas de decenas, unidades y número completo.
     */
    public function analisisDigitos(): JsonResponse
    {
        $sorteos = DB::table('sorteos')
            ->orderBy('id')
            ->pluck('numero');

        $primeraCifra = [];
        $segundaCifra = [];
        $numerosCompletos = [];

        foreach ($sorteos as $numero) {
            // Garantiza dos posiciones, incluso para resultados entre 00 y 09.
            $numero = str_pad((string) $numero, 2, '0', STR_PAD_LEFT);

            $primeraCifra[] = (int) $numero[0];
            $segundaCifra[] = (int) $numero[1];
            $numerosCompletos[] = (int) $numero;
        }

        // Medidas estadísticas para una posición (dígitos de 0 a 9).
        $calcularEstadisticas = function (array $datos): array {
            $n = count($datos);
            $frecuencias = array_fill(0, 10, 0);

            foreach ($datos as $valor) {
                $frecuencias[$valor]++;
            }

            if ($n === 0) {
                return [
                    'total' => 0,
                    'frecuencias' => $frecuencias,
                    'media' => 0,
                    'mediana' => 0,
                    'moda' => [],
                    'varianza' => 0,
                    'desviacion_estandar' => 0,
                ];
            }

            $media = array_sum($datos) / $n;

            $ordenados = $datos;
            sort($ordenados);

            if ($n % 2 === 0) {
                $mediana = (
                    $ordenados[(int) (($n / 2) - 1)] +
                    $ordenados[(int) ($n / 2)]
                ) / 2;
            } else {
                $mediana = $ordenados[(int) floor($n / 2)];
            }

            $frecuenciaMaxima = max($frecuencias);
            $moda = [];

            if ($frecuenciaMaxima > 1) {
                foreach ($frecuencias as $digito => $frecuencia) {
                    if ($frecuencia === $frecuenciaMaxima) {
                        $moda[] = $digito;
                    }
                }
            }

            // Se utiliza varianza poblacional porque se analiza el historial completo.
            $sumaCuadrados = 0;

            foreach ($datos as $valor) {
                $sumaCuadrados += ($valor - $media) ** 2;
            }

            $varianza = $sumaCuadrados / $n;
            $desviacion = sqrt($varianza);

            return [
                'total' => $n,
                'frecuencias' => $frecuencias,
                'media' => round($media, 4),
                'mediana' => round($mediana, 4),
                'moda' => $moda,
                'varianza' => round($varianza, 4),
                'desviacion_estandar' => round($desviacion, 4),
            ];
        };

        // Medidas descriptivas para los resultados completos, tratados como valores 00–99.
        $calcularEstadisticasCompletas = function (array $datos): array {
            $n = count($datos);

            if ($n === 0) {
                return [
                    'total' => 0,
                    'media' => 0,
                    'varianza' => 0,
                    'desviacion_estandar' => 0,
                ];
            }

            $media = array_sum($datos) / $n;
            $sumaCuadrados = 0;

            foreach ($datos as $valor) {
                $sumaCuadrados += ($valor - $media) ** 2;
            }

            $varianza = $sumaCuadrados / $n;
            $desviacion = sqrt($varianza);

            return [
                'total' => $n,
                'media' => round($media, 4),
                'varianza' => round($varianza, 4),
                'desviacion_estandar' => round($desviacion, 4),
            ];
        };

        return response()->json([
            'total_sorteos' => count($sorteos),
            'primera_cifra' => $calcularEstadisticas($primeraCifra),
            'segunda_cifra' => $calcularEstadisticas($segundaCifra),
            'numero_completo' => $calcularEstadisticasCompletas($numerosCompletos),
        ]);
    }

    /**
     * Agrupa los resultados en diez intervalos de diez números.
     */
    public function distribucion(): JsonResponse
    {
        $sorteos = DB::table('sorteos')->pluck('numero');
        $total = $sorteos->count();

        $intervalos = [];

        for ($i = 0; $i < 10; $i++) {
            $inicio = $i * 10;
            $fin = $inicio + 9;

            $intervalos[$i] = [
                'intervalo' => sprintf('%02d–%02d', $inicio, $fin),
                'inicio' => $inicio,
                'fin' => $fin,
                'frecuencia_absoluta' => 0,
                'frecuencia_relativa' => 0,
                'porcentaje' => 0,
                'porcentaje_teorico' => 10,
                'diferencia' => -10,
            ];
        }

        foreach ($sorteos as $numero) {
            $valor = (int) $numero;

            // Los resultados válidos están comprendidos entre 00 y 99.
            if ($valor >= 0 && $valor <= 99) {
                $indice = intdiv($valor, 10);
                $intervalos[$indice]['frecuencia_absoluta']++;
            }
        }

        foreach ($intervalos as &$intervalo) {
            $frecuencia = $intervalo['frecuencia_absoluta'];
            $relativa = $total > 0 ? $frecuencia / $total : 0;
            $porcentaje = $relativa * 100;

            $intervalo['frecuencia_relativa'] = round($relativa, 4);
            $intervalo['porcentaje'] = round($porcentaje, 2);
            $intervalo['diferencia'] = round($porcentaje - 10, 2);
        }
        unset($intervalo);

        return response()->json([
            'total_sorteos' => $total,
            'porcentaje_teorico' => 10,
            'frecuencia_esperada' => round($total / 10, 2),
            'intervalos' => array_values($intervalos),
        ]);
    }

    /**
     * Devuelve la secuencia histórica de sorteos para las gráficas temporales.
     */
    public function serieTemporal(): JsonResponse
    {
        $sorteos = DB::table('sorteos')
            ->orderBy('id', 'asc')
            ->get(['id', 'numero', 'created_at']);

        $resultado = [];

        foreach ($sorteos as $indice => $sorteo) {
            $numero = str_pad(
                (string) $sorteo->numero,
                2,
                '0',
                STR_PAD_LEFT
            );

            $resultado[] = [
                'orden' => $indice + 1,
                'id' => $sorteo->id,
                'numero' => $numero,
                'primera_cifra' => (int) $numero[0],
                'segunda_cifra' => (int) $numero[1],
                'fecha' => $sorteo->created_at,
            ];
        }

        return response()->json([
            'total_sorteos' => count($resultado),
            'serie_temporal' => $resultado,
        ]);
    }
}
