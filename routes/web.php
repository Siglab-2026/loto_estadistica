<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SorteoController;
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