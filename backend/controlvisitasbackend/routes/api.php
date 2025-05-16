<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\motivoController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/helpcheck', function() {
    return 'alive';
});

Route::post('/crearusuario', function(){
    // crear usuario
});

Route::put('/eliminarusuario', function(){

});

Route::get('/verusuario', function(){
    // ver usuario
});

Route::post('/nuevavisita', function(){
    // crear nueva visita
});

Route::get('/vervisitas', function(){
    // ver todas las visitas
});

Route::get('/visitasdia', function(){

});

Route::get('/verdepartamentos', function(){
    // ver todos los departamentos
});

Route::get('/nombredepartamentos', function(){
    
});

Route::get('/motivosdepartamento', [motivoController::class, 'verMotivos']);



