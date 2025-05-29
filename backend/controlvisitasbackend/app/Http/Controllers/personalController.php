<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Personal;



class personalController extends Controller
{
    public function verPersonalNombre(Request $request){
        $nombre = $request->input('nombre', '');
        $apellidopaterno = $request->input('apellidopaterno', '');
        $apellidomaterno = $request->input('apellidomaterno', '');

        $query = DB::table('personal');
        if(!empty($nombre)){
            $query->where('nombre', 'ILIKE', "%{$nombre}%");
        }
        if(!empty($apellidopaterno)){
            $query->where('apellidopaterno', 'ILIKE', "%{$apellidopaterno}%");
        }
        if(!empty($apellidomaterno)){
            $query->where('apellidomaterno', 'ILIKE', "%{$apellidomaterno}%");
        }
        $query->where('cancelado', 'activo' );
        $personal = $query->select('id_personal', 'nombre', 'apellidopaterno', 'apellidomaterno', 'numcel', 'id_departamento', 'num_puesto')->get();

        if(collect($personal)->isEmpty()){
            $data = [
                'message' => 'no se encontraron registros',
                'status' => 404
            ];
            return response()->json($data);
        }
        return response()->json($personal);
    }

    public function verPersonalId(Request $request){
        $id_personal = $request->input('id_personal');
        $personal = DB::select('select id_personal, nombre, apellidopaterno, apellidomaterno, numcel,id_departamento, num_puesto from personal where id_personal = ? and cancelado = ?', [$id_personal, 'activo']);
        if(collect($personal)-> isEmpty()){
            $data=[
                'message' => 'No se encontraron visitas',
                'status' => 404
            ];
            return response()->json($data);
        }
        return response()->json($personal);
    }

    public function eliminarPersonal(Request $request){
        try{
            $id_personal = $request->input('id_personal');
            DB::update('UPDATE personal SET cancelado = ? WHERE id_personal = ?;', ['cancelado',$id_personal]);
            return response()->json(['message' => 'Usuario eliminado con exito'], 201); 
        }catch(QueryException $e){
            return response()->json(['message' => 'Error al eliminar el usuario', 'error' => $e->getMessage()], 500);
        }
    }

    public function crearPersonal(Request $request){
        try{
            $nombre = $request->input('nombre');
            $apellidopaterno = $request->input('apellidopaterno');
            $apellidomaterno = $request->input('apellidomaterno');
            $id_departamento = $request->input('id_departamento');
            $contrasena = $request->input('contrasena');
            $num_puesto = $request->input('num_puesto');
            $numcel = $request->input('numcel');
            $cancelado = 'activo';
            DB::insert('INSERT INTO personal (nombre, apellidopaterno, apellidomaterno, id_departamento, contrasena, num_puesto, numcel, cancelado) VALUES (?,?,?,?,?,?,?,?);', [
                $nombre,
                $apellidopaterno,
                $apellidomaterno,
                $id_departamento,
                $contrasena,
                $num_puesto,
                $numcel,
                $cancelado
            ]);
            return response()->json(['message' => 'Usuario insertado con exito'], 201); 
        }catch(QueryException $e){
            return response()->json(['message' => 'Error al insertar el usuario', 'error' => $e->getMessage()], 500);
        }
    }

    public function verPersonalPuesto(Request $request){
        $num_puesto = $request->input('num_puesto');
        $personal = DB::select('select id_personal, nombre, apellidopaterno, apellidomaterno, numcel,id_departamento, num_puesto from personal where num_puesto = ? and cancelado = ?', [$num_puesto, 'activo']);
        if(collect($personal)-> isEmpty()){
            $data=[
                'message' => 'No se encontraron visitas',
                'status' => 404
            ];
            return response()->json($data);
        }
        return response()->json($personal); 
    }
}
