<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\motivoController;
use App\Http\Controllers\puestosController;
use App\Http\Controllers\departamentoController;
use App\Http\Controllers\visitaController;
use App\Http\Controllers\personalController;


Route::get('/helpcheck', function() {
    return 'alive';
});

Route::get('/verpuestos',[puestosController::class, 'verPuestos']);

Route::post('/crearpersonal', [personalController::class, 'crearPersonal']);

Route::put('/eliminarpersonal', [personalController::class, 'eliminarPersonal']); 

Route::post('/verpersonalid', [personalController::class, 'verPersonalId']);

Route::post('/verpersonalnombre', [personalController::class, 'verPersonalNombre']);

Route::post('/verpersonalpuesto', [personalController::class, 'verPersonalPuesto']);

Route::post('/nuevavisita', [visitaController::class, 'crearVisita']);

Route::post('/vervisitas', [visitaController::class, 'verVisitasActivas']);

Route::post('/visitasdia', [visitaController::class, 'verTodasVisitas']);

Route::put('/terminarvisita', [visitaController::class, 'terminarVisita']);

Route::get('/verdepartamentos', [departamentoController::class, 'verDepartamentos']);

Route::post('/motivosdepartamento', [motivoController::class, 'verMotivos']);
 


