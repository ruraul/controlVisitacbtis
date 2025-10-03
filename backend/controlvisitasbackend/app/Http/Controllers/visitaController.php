<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Visita;
use Illuminate\Database\QueryException;


class visitaController extends Controller
{
    public function verVisitasActivas(Request $request){
        $estatus = $request->input('estatus', 'activo');
        $fecha = $request->input('fecha', now()->toDateString());
        $visitas = DB::select('select id_visita, nombrevisitante, apellidopaternovisitante, apellidomaternovisitante, numcel, id_motivo, fecha, estatus from visita where estatus = ? and fecha::date = ?', [$estatus, $fecha]);
        if(collect($visitas)-> isEmpty()){
            $data=[
                'message' => 'No se encontraron visitas',
                'status' => 404
            ];
            return response()->json($data);
        }
        return response()->json($visitas);
    }
    
    public function verTodasVisitas(Request $request){
        $fecha = $request->input('fecha', now()->toDateString());
        $visitas = DB::select('select id_visita, nombrevisitante, apellidopaternovisitante, apellidomaternovisitante, numcel, id_motivo, fecha, estatus from visita where fecha::date = ?', [$fecha]);
        if(collect($visitas)-> isEmpty()){
            $data=[
                'message' => 'No se encontraron visitas',
                'status' => 404
            ];
            return response()->json($data);
        }
        return response()->json($visitas);
    }

    public function crearVisita(Request $request){
        try{
            $nombrevisitante = $request->input('nombrevisitante');
            $apellidopaternovisitante = $request->input('apellidopaternovisitante');
            $apellidomaternovisitante = $request->input('apellidomaternovisitante');
            $numcel = $request->input('numcel');
            $id_motivo = $request->input('id_motivo');
            $fecha = now();
            $estatus = 'activo';
            DB::insert('INSERT INTO visita (nombrevisitante, apellidopaternovisitante, apellidomaternovisitante, numcel, id_motivo, fecha, estatus) VALUES (?,?,?,?,?,?,?);', [
                $nombrevisitante,
                $apellidopaternovisitante,
                $apellidomaternovisitante,
                $numcel,
                $id_motivo,
                $fecha,
                $estatus,
            ]);
            return response()->json(['message' => 'Visita creada con exito'], 201); 
        }catch(QueryException $e){
            return response()->json(['message' => 'Error al crear nueva visita', 'error' => $e->getMessage()], 500);
        }
    }

    public function terminarVisita(Request $request){
        try{
            $id_visita = $request->input('id_visita');
            DB::update('UPDATE visita SET estatus = ? WHERE id_visita = ?', ['terminado',$id_visita]);
            return response()->json(['message' => 'visita terminada con exito'], 201); 
        }catch(QueryException $e){
            return response()->json(['message' => 'Error al terminar visita', 'error' => $e->getMessage()], 500);
        }
    }

}
