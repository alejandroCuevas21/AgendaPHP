<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendasController;
use App\Http\Controllers\ExportarController;
use App\Http\Controllers\Middleware;

Route::get('/', function () {
    return view('layouts.app'); 
});

Route::get('/ConsultaAgenda', [AgendasController::class, 'VisualizarConsultaAgenda'])->name('Agenda.ConsultaAgenda');

Route::get('/InsertaAgenda{id?}', [AgendasController::class, 'VisualizarInsertarContacto'])->name('Agenda.InsertarAgenda');

Route::get('/ActualizaAgenda/{id}', [AgendasController::class, 'VisualizarInsertarContacto'])->name('Agenda.ActualizarAgenda');

Route::get('agendas/ConsutaRegistroAgenda/{id}', [AgendasController::class, 'ConsultaRegistroAgenda'])->name('ConsultaRegistroAgenda');

Route::put('/agendas/ActualizarAgenda/{id}', [AgendasController::class, 'ActualizarAgenda']);
Route::post('/agendas/InsertarAgenda', [AgendasController::class, 'InsertarAgenda']);
Route::get('/exportarExcel', [ExportarController::class, 'ExportarExcel'])->name('Exportar');

  

