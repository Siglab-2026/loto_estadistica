<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SorteoController;
use App\Http\Controllers\PronosticoController;
use App\Models\Sorteo;

#Route::get('/', function () {
   # return view('welcome');
#});

Route::get('/', function () {
    return view('loto');
});



Route::get('/sorteo/generar', [SorteoController::class, 'generar']);

Route::get('/sorteos/historial', function () {
    return Sorteo::query()
        ->latest('id')
        ->limit(20)
        ->get(['id', 'numero', 'created_at']);
});

Route::get('/estadisticas/frecuencias', [SorteoController::class, 'frecuencias']);
Route::get('/estadisticas', function () {
    return view('estadisticas');
});

Route::get('/estadisticas/analisis-digitos', [SorteoController::class, 'analisisDigitos']);


Route::get('/estadisticas/serie-temporal', [SorteoController::class, 'serieTemporal']);

Route::get('/estadisticas/distribucion', [SorteoController::class, 'distribucion']);



Route::get('/pronostico/generar', [PronosticoController::class, 'generar'])
    ->name('pronostico.generar');

    Route::get('/pronostico', function () {
    return view('pronostico');
})->name('pronostico.index');

Route::get('/pronostico/historial', [PronosticoController::class, 'historial'])
    ->name('pronostico.historial');

    Route::post('/pronostico/evaluar', [PronosticoController::class, 'evaluar'])
    ->name('pronostico.evaluar');

    