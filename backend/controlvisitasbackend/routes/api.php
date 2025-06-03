<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\motivoController;
use App\Http\Controllers\puestosController;
use App\Http\Controllers\departamentoController;
use App\Http\Controllers\visitaController;
use App\Http\Controllers\personalController;
use App\Http\Controllers\AuthController;


Route::get('/helpcheck', function() {
    return 'alive';
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/user', [AuthController::class, 'updateUser']);
    Route::post('/verpersonalpuesto', [personalController::class, 'verPersonalPuesto']);

    Route::get('/verpuestos',[puestosController::class, 'verPuestos']);
    Route::get('/verdepartamentos', [departamentoController::class, 'verDepartamentos']);
    Route::post('/motivosdepartamento', [motivoController::class, 'verMotivos']);

    Route::post('/verpersonalnombre', [personalController::class, 'verPersonalNombre']);
    Route::post('/verpersonalid', [personalController::class, 'verPersonalId']);
    Route::put('/eliminarpersonal', [personalController::class, 'eliminarPersonal']);
    Route::post('/crearpersonal', [personalController::class, 'crearPersonal']);
    Route::put('/actualizarcontrasena', [personalController::class, 'actualizarContrasena']);


    Route::post('/nuevavisita', [visitaController::class, 'crearVisita']);
    Route::post('/vervisitas', [visitaController::class, 'verVisitasActivas']);
    Route::post('/visitasdia', [visitaController::class, 'verTodasVisitas']);
    Route::put('/terminarvisita', [visitaController::class, 'terminarVisita']); 
});
 


